<?php

	define("DB_SERVER","localhost");
	define("DB_USER","bookmarks");
	define("DB_PASS","tralala");
	define("DB_NAME","bookmarks");
	
	define("DB_TABLE","b_categories");
	$cols = array("catid","catname","userid");
	
	class MySQLDB {
		var $id_col = "catid";
	
		function connection1() {
			global $str_debug;
			$this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die (mysql_error());
			mysql_select_db(DB_NAME);
		}
		
		function close_connection() {
			mysql_close($this->connection);
		}
		
		function get_info($cols) {
			$s = "SELECT * FROM ".DB_TABLE;
			$q = mysql_query($s);
			while ($res = mysql_fetch_array($q)) {
				foreach ($res as $key => $val) {
					if (in_array($key,$cols) && !is_numeric($key)) {
						$this->masiv[$res[$this->id_col]][$key]=$this->cleaninput((mb_detect_encoding($val,"auto") == "ASCII" ? mb_convert_encoding($val, "UTF-8", "ASCII") : $val));
					}
				}
			}
			print "<pre>";
			#print_r($this->masiv);
			#print_r($encoding);
			print "</pre>";
			
		}
		
		function cleaninput($input) {
			if(get_magic_quotes_gpc() ) $input = stripslashes($input);
			$input = strip_tags($input);
			return mysql_real_escape_string($input);
		}
		
		function insert_into($cols) {
			foreach($this->masiv as $key => $foo) {
				$cnt = count($foo);
				$s = "INSERT INTO ".DB_TABLE." (".implode(",",$cols).") VALUES (";
				$i = 1;
				foreach ($foo as $colname => $value) {
					$s .= "\"$value\"";
					($i < $cnt ? $s .= "," : false);
					$i++;
				}
				$s .= ");";
				print $s . "<br />";
			}
		}
		
	}
	
	$db = new MySQLDB;
	$db->connection1();
	$db->get_info($cols);
	$db->close_connection();
	
	$db->insert_into($cols);
?>