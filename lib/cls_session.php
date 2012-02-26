<?php

	class session {
		function session() {
			$ip = $_SERVER["REMOTE_ADDR"];
			$time = time();
			$logedUser = $_SESSION["logeduserid"];
			
			$db_users = new db_users;
			
			/* Checks if guest is in the database
			*	if he is - update time
			*	else record him
			*/
			if ($db_users->if_userloged() != 1) {
				if ($db_users->check_guest($ip, $time) == 1) {
					$db_users->update_guest($ip, $time);
				} else {
					$db_users->record_guest($ip, $time);
				}
			} else {
				if ($db_users->is_user_active($logedUser) == true) {
					$db_users->update_active_user($logedUser,$time);
				} else {
					$db_users->record_logedUser($logedUser,$time);
				}
			}
		}
		
		function gen_uniq($rnd=0,$length=12) {
			srand((double)microtime()*10000000+$rnd);
			$Pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890';
			$sid = '';
			for($index = 0; $index < $length; $index++) {
				$sid .= substr($Pool, (rand()%(strlen($Pool))), 1);
			}
			return($sid);
		}
		
		/*	Destoing loged user session */
		function destroy_user_session() {
		
			$db_users = new db_users;
			
			$userid_str = $_SESSION["userid_str"];
			$userid = $_SESSION["logeduserid"];
			//$db_users->destroy_active_user($userid,$userid_str);
			unset($userid_str);
			unset($userid);
			$cookie_data = explode(";",$_COOKIE["bkm_remember"]);
			$db_users->delete_remembrance($cookie_data[0],$cookie_data[1]);
			setcookie("bkm_remember","",0,"/");
		}
		
		/* Record user in COOKIE */
		function remember_me($userid) {
			if (isset($_POST["rememberme"])) {
				$this->remember_str = $this->gen_uniq();
				setcookie("bkm_remember",$userid.";".$this->remember_str,time()+86400*60,"/");
			} else {
				$this->remember_str = "";
				setcookie("bkm_remember","",0,"/");
			}
		}
	}
	$session = new session;
?>