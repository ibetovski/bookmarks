<?php
	class forms {
		var $bindings;
		var $updatefield;
		
		var $error_msg = "";
		var $error_title = "Системата не успя да вземе заглавието от сайта авмотамитчно. Моля, попълнете го ръчно.";
		var $error_empty = "Моля, попълнете задължителните полета.";
		
		function forms() {
			if (isset($_POST["submit"])) {
				$this->check_bindings();
			}
		}
		
		function print_error($msg="") {
			return "<div class=\"error_msg\">".($msg != "" ? $msg : ($this->error_msg != "" ? $this->error_msg : ""))."</div>";
		}
		
		function check_bindings() {
			if (is_array($this->bindings)) {
				foreach($this->bindings as $field) {
					if ($_POST) {
						if (strlen($_POST[$field]) < 1 ) {
							$this->emptyFields[$field]=$field;
						}
					}
				}
			}
		}
		
		function clean_input($input) {
			if(get_magic_quotes_gpc() ) $input = stripslashes($input);
			$input = strip_tags($input);
			return mysql_real_escape_string($input);
		}
		
		function prepare_values() {
			if (isset($this->columns) && is_array($this->columns)) {
				foreach ($this->columns as $col) {
					if ($col == "catid" && isset($this->catid)) {
						/* If adding new category */
						$this->values["catid"] = "\"".$this->clean_input($this->catid)."\"";
					} else {
						$this->values[$col] = "\"".$this->clean_input($_POST[$col])."\"";
					}
				}
			}
		}
		
		function print_inputJSactions($js_func, $field) {
			$actions = array('onkeypress','onchange','onkeyup','onkeydown','onblur','onfocus','onclick');
			return implode("=\"" . $js_func[$field] . "\" ", $actions) . "=\"" . $js_func[$field] . "\"";
		}
		
		function print_input($type,$class,$field,$value) {
			$test = "<input type=\"$type\" name=\"$field\" id=\"$field\""
			. " class=\"$class"
			. (isset($_POST["submit"]) ? (count($this->emptyFields) != 0 ? (in_array($field,$this->emptyFields) ? " empty" : false) : false ) : false ) . "\""
			. ($type == "checkbox" ? (($value == "on" || $value == 1) ? " checked " : false ) : false ) 
			#. (isset($_POST["submit"]) ? (count($this->wrongNumericFields) != 0 ? (in_array($field,$this->wrongNumericFields) ? " wrong" : false ) : false ) : false )
			#. (isset($_POST["submit"]) ? (count($this->wrongEmails) != 0 ? (in_array($field,$this->wrongEmails) ? " wrong" : false ) : false ) : false )
			#. (array_key_exists($field,$this->js_calcinputs) ?  $this->print_inputJSactions($this->js_calcinputs, $field) . " value=\"" . (strlen($value) != 0 ? $value : 0) . "\""  : ($type == "checkbox" ? false : " value=\"$value\"")) . " />";
			.($value ? " value=\"$value\"" : "")." />";
			return $test;
		}
		
		function print_select($masiv,$field,$id,$multi=false) {
			if (is_array($masiv)) {
				$html = "<select name=\"$field".($multi ? "[]\" multiple=\"multiple\" size=\"10\"" : "")."\">\n";
				foreach ($masiv as $key => $val) {
					$html .= "<option value=\"$key\"" . (is_array($id) ? (in_array($key,$id) ? " selected" : "") : ($id == $key ? " selected" : "")).">$val</option>";
				}
				$html .= "</select>";
				return $html;
			}
		}
		
		function print_textarea($class,$field,$value) {
			return "<textarea class=\"$class" . ($_POST["submit"] ? (count($this->emptyFields) != 0 ? (in_array($field,$this->emptyFields) ? " empty" : false) : false) : false ) . "\" name=\"$field\">$value</textarea>";
		}
		
		function insert() {
			global $str_debug;
			$this->prepare_values();
			if (!isset($this->emptyFields)) {
				$s = "INSERT INTO " .$this->table." (".implode(",",$this->columns).") VALUES (".implode(",",$this->values).")";
				$str_debug .= $s . "<hr />";
				$q = mysql_query($s) or die("<pre>".$s."</pre>" . mysql_error());
				#header("Location: " . BASEDIR . $this->location);
			} else {
				(!isset($this->emptyFields["b_title"]) ? $this->error_msg = $this->error_empty : false);
			}
		}
		
		function update($id) {
			global $str_debug;
			$this->prepare_values();
			if ($this->updatefield != "") {
				if (!isset($this->emptyFields)) {
					foreach ($this->values as $field => $value) {
						$updateFields[$field] = $field . "=" . $value;
					}
					$s = "UPDATE ".$this->table." SET ".implode(",",$updateFields)." WHERE ".$this->updatefield."='$id'";
					print $s;
					$q = mysql_query($s) or die(mysql_error());
					$str_debug .= $s . "<hr />";
				} else {
					(!isset($this->emptyFields["b_title"]) ? $this->error_msg = $this->error_empty : false);
				}
			}
		}
		/*	REGULAR EXPRESSIONS
		++++++++++++++++++++++++*/
	}
	
	class loginForm extends forms {
		var $bindings=array("username","password");
		function logincheck() {
			$database = new MySQLDB;
			if ($_POST) {
				
				if (!isset($this->emptyFields)) {
					$username = $_POST['username'];
					$real_password = $_POST['password'];
					$username = stripslashes($username);
					$password = stripslashes(md5($real_password));
					$username = mysql_real_escape_string($username);
					$password = mysql_real_escape_string($password);
					
					$session = new session;
					$db_users = new db_users;
					
					
					// проверява,дали паролата и юзъра съвпадат с данните от базата
					$match_pass = @mysql_query("SELECT userid FROM ".TBL_USERS." WHERE u_nick='$username' AND u_password='$password' AND approved='1'");
					$this->match_pass_cnt = @mysql_num_rows($match_pass);
					if ($this->match_pass_cnt == 1) {
						$row = mysql_fetch_array($match_pass);
						extract($row);
						$_SESSION["logeduserid"] = $userid;
						
						//при успешен логин препраща на страницата с букмарките
						session_register("username");
						$uniq_id = $session->gen_uniq();
						$time = time();
						$_SESSION["userid_str"]=$uniq_id;
						$session->remember_me($userid);
						$db_users->remember_me($userid,$session->remember_str);
						if ($db_users->is_user_active($userid) == false) {
							$db_users->record_logeduser($userid, $time, $uniq_id);
						} else {
							$db_users->update_active_user($userid,$time,$uniq_id);
						}
						header("Location: " . BASEDIR);
					} else {
						$this->login_error=1;
						$this->error_msg = "Въвели сте грешна парола или този потребител не съществува";
					}
				} else {
					$this->error_msg = "Попълнете задължителните полета";
				}
			}
		}
	}
	
	class register_form extends forms {
		var $bindings = array("u_nick","u_email","password","password1");
		function add_user($u_nick,$email,$pass1,$pass2) {
			
			global $md5password, $db_users;
			$db_users=new db_users;
			
			$u_nick = mysql_real_escape_string($u_nick);
			$email = mysql_real_escape_string($email);
			$pass1 = mysql_real_escape_string($pass1);
			$pass2 = mysql_real_escape_string($pass2);
			
			if (!isset($this->emptyFields)) {
				if (!preg_match("/^[a-zA-Z][a-zA-Z0-9_]/", $u_nick)) {
					$this->error_msg = "Потребителското име трябва да е само с букви и цифри";
					return 0;
				} else {
					$is_nick_free = $db_users->is_nick_free($u_nick);
					if ($is_nick_free != 1) {
						$this->error_msg = "Това потребителско име вече е заето";
						return 0;
					}
				}
				
				/* email validation */
				$qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
				$dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
				$atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
							  '\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
				$quoted_pair = '\\x5c[\\x00-\\x7f]';
				$domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
				$quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
				$domain_ref = $atom;
				$sub_domain = "($domain_ref|$domain_literal)";
				$word = "($atom|$quoted_string)";
				$domain = "$sub_domain(\\x2e$sub_domain)*";
				$local_part = "$word(\\x2e$word)*";
				$addr_spec = "$local_part\\x40$domain";

				if (!preg_match("!^$addr_spec$!", $email)) {
					$this->error_msg = "Грешен майл";
					return 0;
				}
				
				if ($pass1 == $pass2) {
					$md5password = md5($pass1);
				} else {
					$this->error_msg = "Двете пароли не съвпадат";
					return 0;
				}
				return 1;
			} else {
				$this->error_msg = "Попълнете задължителните полета";
				return 0;
			}
		}
		
		function send_approve_mail($u_nick, $u_email, $u_password, $uniq_id) {
			
			/* Send email */
			$headers = "From: " . EMAIL_FROMNAME . " <" . EMAIL_FROM. ">\n";
			$headers .= "Return-path: " . EMAIL_FROM . "\n";
			$headers .= "Content-type: text/plain; charset=utf8\n";

			$body  = "Потребителско име     : " . "$u_nick\n";
			$body .= "За да активирате потребителското си име, кликнете тук  : " . "http://{$_SERVER['HTTP_HOST']}" . BASEDIR . "login/register.php?app=$uniq_id" . "\n";
			$body .= str_repeat("-", 72)."\n";
			$body = ereg_replace("\r","",$body);

			$subject = EMAIL_FROMNAME . " | Активация на потребителско име";

			mail($u_email, $subject, $body, $headers);
		}
		
		function send_mailtoAmin($u_nick, $u_email) {
			/* Send email */
			$headers = "From: " . EMAIL_FROMNAME . " <" . EMAIL_FROM. ">\n";
			$headers .= "Return-path: " . EMAIL_FROM . "\n";
			$headers .= "Content-type: text/plain; charset=utf8\n";

			$body  = "Потребителско име     : " . "$u_nick\n";
			$body .= "E-mail     : " . "$u_email\n\n";
			#$body .= "За да активирате потребителското име, кликнете тук  : " . "http://{$_SERVER['HTTP_HOST']}" . BASEDIR . "login/register.php?app=$uniq_id" . "\n";
			#$body .= "За да ИЗТРИЕТЕ потребителското име, кликнете тук  : " . "http://{$_SERVER['HTTP_HOST']}" . BASEDIR . "login/register.php?app=$uniq_id&del=1" . "\n";
			$body .= str_repeat("-", 72)."\n";
			$body = ereg_replace("\r","",$body);

			$subject = EMAIL_FROMNAME . " | Нова регистрация | " . $u_nick;

			mail(EMAIL_FROM, $subject, $body, $headers);
		}
	}
	
	class addForm extends forms {
		var $table = TBL_SITES;
		var $columns = array("catid","b_title","b_url","b_desc","userid");
		var $bindings = array("catid","b_title","b_url","userid");
		var $location = "";
		var $updatefield = "bid";
		
		function add_new_category($name) {
			$categories = new categories;
			$categories->add_category($name);
			$this->catid = $categories->last_added();
		}
		
		function getTitle($url) {
			if ($url != "") {
				$fh = fopen($url, "r");
				$str = fread($fh, 7500);
				//$str_encoding = mb_detect_encoding($str);
				//$str_charset = mb_preferred_mime_name($str);
				fclose($fh);
				if (preg_match("{charset=(.*?)\"}",$str, $match)) {
					$char = strtolower($match[1]);
				}
				if (preg_match("{<title>(.*?)</title>}",$str, $title) || preg_match("{<TITLE>(.*?)</TITLE>}",$str, $title)) {
					$title = strip_tags($title[0]);
					if ($char != "utf8") {
						$conv_str = iconv($char, "UTF8", $title);
						return $conv_str;
					} else {
						return $title;
					}
					#return strip_tags($title[0]);
				}
				//return $char;
			}
		}
		
		function getImg($url) {
			if ($url != "") {
				$fh = fopen($url,"r");
				$str = fread($fh, 14000);
				fclose($fh);
				print $str;
				if (preg_match_all("{<img (.*?)>}",$str,$img)) {
					$arrRes = array();
					#array_debug($img);
					if (is_array($img[1])) {
						foreach($img[1] as $key => $val) {
							if (preg_match("{src=\"(.*?)\"}",$val,$imgSource)) {
								#array_debug($imgSource);
								$res = $imgSource[1];
								if (!preg_match("/^http:\/\//",$res,$foo)) {
									if (preg_match("/^http:\/\/(.*?)\/(.*?)/",$url,$arrTest)) {
										#array_debug($arrTest);
										$arrRes[] = $arrTest[0] . $res;
									}
									print "Не започва с HTTP";
								} else {
									print "Започва с HTTP";
									$arrRes[] = $res;
								}
							} else {
								print $imgSource;
								print "Нещо не е наред с пробата за вземане на рисунка";
							}
						}
						array_debug($arrRes);
						return $arrRes;
					}
				} else {
					print "Нещо не е наред с пробата за вземане на рисунка НА ВТОРО НИВО";
					return 0;
				}
			} else {
				return 0;
			}
		}
	
	}
	
	/*	ERROR MSGS	*/
	class error extends forms {
		var $er_empty="Попълнете задължителните полета";
		function print_error($msg) {
			print "<div class=\"error_msg\">$msg</div>";
		}
	}