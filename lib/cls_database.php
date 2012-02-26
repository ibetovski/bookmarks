<?php

	class MySQLDB {
		var $connection;
		var $num_active_users;
		var $num_active_guests;
		var $num_members; 
		
		/* Class Construct */
		function MySQLDB() {
			global $str_debug;
			
			$this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die (mysql_error());
			mysql_select_db(DB_NAME);
			mysql_query("set names utf8");
		}
		
		/* изпълнява куерито */
		function sql_select($sql) {
			global $str_debug;
			if ($sql != "") {
				$str = $sql;
				$str_debug .= $str . "<hr />";
				$q = mysql_query($str) or die(mysql_error());
				return $q;
			}
		}
		
		function clean_input($input) {
			if(get_magic_quotes_gpc() ) $input = stripslashes($input);
			$input = strip_tags($input);
			return mysql_real_escape_string($input);
		}
		
		function delete($id) {
			global $str_debug;
			$s = "DELETE FROM ".$this->table ." WHERE ".$this->id_col."='$id'";
			print $s;
			$q = mysql_query($s) or die(mysql_error());
			$str_debug .= $s . "<hr />";
			if ($this->table == TBL_CATEGORIES) {
			    $this->delete_relatives($id);
			}
		}
		
		
	}
	
	/*	USERS CLASS */
	class db_users extends MySQLDB {
	
		/*	Checks if Guest is in the database */
		function check_guest($ip, $time) {
			global $str_debug;
			$s = "SELECT ip FROM " . TBL_ACTIVE_GUESTS . " WHERE ip='$ip'";
			$q = $this->sql_select($s);
			$res = mysql_num_rows($q);
			return ($res > 0 ? 1 : 0);
		}
		
		/* Records guest user in database */
		function record_guest($ip, $time) {
			global $str_debug;
			$sql = "INSERT INTO ".TBL_ACTIVE_GUESTS ." (ip,timestamp) VALUES ('$ip','$time')";
			$str_debug .= $sql . "<hr />";
			mysql_query($sql,$this->connection) or die(mysql_error());
		}
		
		/* If Guest exists update him in database */
		function update_guest($ip, $time) {
			global $str_debug;
			$q = "UPDATE ".TBL_ACTIVE_GUESTS." SET timestamp='$time' WHERE ip='$ip'";
			mysql_query($q) or die(mysql_error());
			$str_debug .= $q . "<hr />";
		}
		
		/* Checks if user is already loged */
		function if_userloged() {
			global $str_debug;
			
			if (isset($_SESSION["userid_str"])) {
				$userid_str=$_SESSION["userid_str"];
				$s = "SELECT * FROM " . TBL_ACTIVE_USERS . " WHERE userid_str='$userid_str'";
				$q = $this->sql_select($s);
				$res = mysql_num_rows($q);
				$str_debug .= $s . "<hr />";
				return ($res > 0 ? 1: 0);
			} else {
				return 0;
			}
		}
		
		/* When user logins record him in active users */
		function record_logeduser($userid,$time,$userid_str="") {
			global $str_debug;
			$s = "INSERT INTO ".TBL_ACTIVE_USERS." (userid,timestamp,userid_str) VALUES ('$userid','$time','$userid_str')";
			mysql_query($s) or die($s . " <hr /> " . mysql_error());
			$str_debug .= $s . "<hr />";
		}
		
		/* If loged user is already in Active users */
		function is_user_active($id) {
			$s = "SELECT userid FROM " . TBL_ACTIVE_USERS . " WHERE userid=" . $id;
			$q = $this->sql_select($s);
			$cnt = mysql_num_rows($q);
			return ($cnt > 0 ? true : false);
		}
		
		function update_active_user($id,$time,$userid_str="") {
			$s = "UPDATE ".TBL_ACTIVE_USERS." SET timestamp=".$time. ($userid_str != "" ? ",userid_str='".$userid_str."'" : ""). " WHERE userid=".$id;
			$q = mysql_query($s) or die($s . " <hr /> " . mysql_error());
			$str_debug .= $s . "<hr />";
		}
		
		
		/* On logout delete active user in database */
		function destroy_active_user($userid,$userid_str) {
			global $str_debug;
			$s = "DELETE FROM ".TBL_ACTIVE_USERS." WHERE userid='$userid' AND userid_str='$userid_str'";
			mysql_query($s) or die(mysql_error());
			$str_debug .= $s . "<hr />";
		}
		
		/* Checks if register nickname is free */
		function is_nick_free($u_nick) {
			global $str_debug;
			$s = "SELECT * FROM " . TBL_USERS . " WHERE u_nick='$u_nick'";
			$q = $this->sql_select($s);
			$cnt = mysql_num_rows($q);
			return ($cnt > 0 ? 0 : 1);
		}
		
		/* add new user */
		function add_user($u_nick,$u_email,$u_password) {
			global $str_debug, $uniq_id;
			$session = new session;
			$uniq_id = $session->gen_uniq($rnd=0, $length=32);
			$s = "INSERT INTO " . TBL_USERS . " (u_nick, u_email, u_password, approve_str, approved) VALUES ('$u_nick', '$u_email', '$u_password', '$uniq_id', '0')";
			mysql_query($s) or die(mysql_error());
			$str_debug .= $s . "<hr />";
		}
		
		function approve_user($str) {
			global $str_debug;
			$sql = "SELECT userid FROM " . TBL_USERS." WHERE approve_str='$str' AND approved='0'";
			$q = $this->sql_select($sql);
			$cnt = mysql_num_rows($q);
			if ($cnt > 0) {		
				$s = "UPDATE ".TBL_USERS." SET approved='1' WHERE approve_str='$str'";
				$str_debug .= $s . "<hr />";
				$update = mysql_query($s) or die(mysql_error());
				return true;
			} else {
				return false;
			}
		}
		
		function show_logedUser() {
			$s = "SELECT u_nick FROM ".TBL_USERS." WHERE userid='".logedUser."'";
			$q = $this->sql_select($s);
			$result = mysql_fetch_array($q);
			return $result["u_nick"];
		}
		
		/* Remember me */
		function remember_me($userid,$remember_str) {
			if ($remember_str != "") {
				if ($this->is_remembered_yet($userid,$remember_str) != true) {
					$this->record_remembered($userid,$remember_str);
				}
				return true;
			} else {
				return false;
			}
		}
		
		function record_remembered($userid,$remember_str) {
			$s = "INSERT INTO ".TBL_REMEMBERED." (userid,remember_str) VALUES ('$userid','$remember_str')";
			$q = $this->sql_select($s);
		}
		
		function is_remembered_yet($userid,$remember_str) {
			$s = "SELECT * FROM ".TBL_REMEMBERED." WHERE userid='$userid' AND remember_str='$remember_str'";
			$q = $this->sql_select($s);
			$cnt = mysql_num_rows($q);
			if ($cnt > 0 && $cnt <= 1) {
				if (!isset($_SESSION["logeduserid"]) && !isset($_SESION["userid_str"])) {
					$_SESSION["logeduserid"] = $userid;
					session_register("username");
					$time = time();
					$uniq_id = gen_uniq();
					$_SESSION["userid_str"]=$uniq_id;
					if ($this->is_user_active($userid) == false) {
						$this->record_logeduser($userid, $time, $uniq_id);
					} else {
						$this->update_active_user($userid,$time,$uniq_id);
					}
				}
				return true;
			} else {
				return false;
			}
		}
		
		function delete_remembrance($userid,$remember_str) {
			$s = "DELETE FROM ".TBL_REMEMBERED." WHERE userid='$userid' AND remember_str='$remember_str'";
			$q = $this->sql_select($s);
		}
		
		/* Statistics */
		function get_active_users() {
			$b_15min = time() - (15 * 60);
			$s = "SELECT u_nick FROM ".TBL_ACTIVE_USERS."
					LEFT JOIN ".TBL_USERS." USING (userid)
					WHERE timestamp > $b_15min
					ORDER BY timestamp";
			$q = $this->sql_select($s);
			while ($result = mysql_fetch_array($q)) {
				extract($result);
				$masiv[]=$u_nick;
			}
			return $masiv;
		}
		
		function cnt_guests() {
			$str = "";
			$b_15min = time() - (15 * 60);
			$s = "SELECT ip FROM ".TBL_ACTIVE_GUESTS." WHERE timestamp > ".$b_15min;
			$q = $this->sql_select($s);
			$cnt = mysql_num_rows($q);
			return $cnt;
		}
		
		
	}
	
	class categories extends MySQLDB {
		var $table = TBL_CATEGORIES;
		var $id_col = "catid";
		
		function add_category($name) {
			global $str_debug;
			$s = "INSERT INTO " . TBL_CATEGORIES . " (catname, userid) VALUES ('$name','".logedUser."')";
			$q = mysql_query($s) or die("<pre>".$s."</pre>" . mysql_error());
			$str_debug .= $s . "<hr />";
		}
		
		function last_added() {
			global $str_debug;
			$s = "SELECT MAX(catid) AS 'catid' FROM " . TBL_CATEGORIES . " WHERE userid=".logedUser;
			$q = $this->sql_select($s);
			$result = mysql_fetch_array($q);
			return $result["catid"];
		}
		
		function get_user_categories() {
			$s = "SELECT * FROM ".$this->table."
				WHERE (userid='".logedUser . "')";
			$q = $this->sql_select($s);
			$cnt = mysql_num_rows($q);
			if ($cnt > 0) {
				while($res = mysql_fetch_array($q)) {
					extract($res);
					$masiv[$catid]=$catname;
				}
				return $masiv;
			} else {
				return 0;
			}
		}
		
		function delete_relatives($id) {
			$s = "DELETE FROM ".TBL_SITES." WHERE catid='$id'";
			$q = $this->sql_select($s);
		}
	}
	
	class db_websites extends MySQLDB {
		var $table = TBL_SITES;
		var $id_col = "bid";
		
		function search_query($search="") {
			if ($search != "") {
				$search = $this->clean_input($search);
				$search_masiv = explode(" ",$search);
				$b_url = "b_url";
				$b_title = "b_title";
				$b_desc = "b_desc";
				$max_index = count($search_masiv) - 1;
				$this->where_search = "";
				$this->where_search .= "(";
				$i = 0;
				foreach ($search_masiv as $key =>$word) {
					/*$a = " REPLACE($b_url, '$word', '<b class=\"match$i\">$word</b>')";
					$b = " REPLACE($b_title, '$word', '<b class=\"match$i\">$word</b>')";
					$c = " REPLACE($b_desc, '$word', '<b class=\"match$i\">$word</b>')";
					
					$a .= " as 'b_url'";
					$b .= " as 'b_title'";
					$c .= " as 'b_desc'";*/

					$this->where_search .= " \n(b_title LIKE '%$word%' OR b_desc LIKE '%$word%' OR b_url LIKE '%$word%') ";
					$this->where_search .=($key != $max_index ? " OR " : "");
					$i++;
					$word = $word;
				}
				$this->where_search .= ")";
				#$a .= " as 'replace_b_url'";
				#$b .= " as 'replace_b_title'";
				#$c .= " as 'replace_b_desc'";
				
				#$this->search_cols = ", $a, $b, $c";
			}
		}
		
		function input_replace($search,$input) {
			$search = $this->clean_input($search);
			$search_masiv = explode(" ",$search);
			$i = 0;
			foreach ($search_masiv as $key => $word) {
				$input = preg_replace("/$word/i", "<b class=\"match$i\">$word</b>", $input);
				$i++;
			}
			return $input;
		}
		
		function delete($id) {
			$s = "DELETE FROM ".TBL_SITES." WHERE bid=$id AND userid=".logedUser;
			mysql_query($s) or die($s . mysql_error());
		}
		
		function get_bookmarks($search="") {
			$s = "SELECT *";
			if ($search != "") {
				$this->search_query($search);
				#$s .= $this->search_cols;
			}
			$s .= "\nFROM ".$this->table."
				LEFT JOIN b_categories USING (catid)
				LEFT JOIN colors USING (colorid)
				WHERE b_sites.userid='".logedUser."'";
			$s .= ((CNTR_CAT == 0 || CNTR_CAT == "") ? " " : " AND catid='".CNTR_CAT."'");
			if ($search != "") {
				$s .= " AND " . $this->where_search;
			}
			$s .= " ORDER BY bid DESC";
			$bookmarks_pages = new bookmarks_pages;
			$bookmarks_pages->mysql_pages($s);
			$q = $this->sql_select($bookmarks_pages->sqlWithPages);
			$q1 = $this->sql_select($s);
			$this->cnt_bkm = mysql_num_rows($q1);
			$this->total_pages = $bookmarks_pages->total_pages;
			$this->list_start_number = $bookmarks_pages->offset;
			
			if ($this->cnt_bkm > 0) {
				while ($res = mysql_fetch_array($q)) {
					extract($res);
					$masiv[$bid]["name"]=$b_title;
					$masiv[$bid]["url"]=$b_url;
					$masiv[$bid]["desc"]=$b_desc;
					$masiv[$bid]["catid"]=$catid;
					$masiv[$bid]["catname"]=$catname;
					if ($colorid > 0) {
						$masiv[$bid]["color_code"]=$color_code;
					}
					if ($search != "") {
						$masiv[$bid]["replace_name"]=$this->input_replace($search,$b_title);
						$masiv[$bid]["replace_url"]=$this->input_replace($search,$b_url);
						$masiv[$bid]["replace_desc"]=$this->input_replace($search,$b_desc);
					}
				}
				return $masiv;
			} else {
				return 0;
			}
		}
		
		function get_edited_item($bid) {
			$s = "SELECT ".$this->table.".* FROM ".$this->table."
				LEFT JOIN ".TBL_CATEGORIES." USING (catid)
				WHERE bid='$bid'";
			$q = $this->sql_select($s);
			$res = mysql_fetch_array($q);
			return $res;
		}
		
		function set_color($bid,$colorid) {
			$s = "UPDATE ".TBL_SITES." SET colorid='$colorid' WHERE bid='$bid'";
			$q = $this->sql_select($s);
			$res_color = $this->get_color($bid);
			return $res_color;
		}
		
		function get_color($bid) {
			$s = "SELECT color_code FROM ".TBL_SITES."
				LEFT JOIN ".TBL_COLORS." USING (colorid)
				WHERE bid='$bid'";
			$q = $this->sql_select($s);
			$res = mysql_fetch_array($q);
			return $res[0];
		}
		
		function get_colors() {
			$s = "SELECT * FROM ".TBL_COLORS;
			$q = $this->sql_select($s);
			while($res = mysql_fetch_array($q)) {
				extract($res);
				$arr[$colorid]["name"] = $color_title;
				$arr[$colorid]["code"] = $color_code;
			}
			return $arr;
		}
	}
?>