<?php
ob_start();
session_start();
include("lib/config.php");

	$db_users = new db_users;
	if (isset($_COOKIE["bkm_remember"])) {
		$cookie_data = explode(";",$_COOKIE["bkm_remember"]);
		$remembered = $db_users->is_remembered_yet($cookie_data[0],$cookie_data[1]);
	} else {
		$remembered = false;
	}
	
	if (isset($_SESSION["logeduserid"])) {
		define("logedUser", ($_SESSION["logeduserid"]));
	}



	//	Ако някой се е логнал, праща на страницата с букмарки
	if (session_is_registered(username) || $remembered == true) {
		if (CNTR_PAGE == "ajax") {
			include(ROOTDIR . "lib/ajax_post.php");
		} else {
			include(ROOTDIR . "bookmarks/list.php");
		}
	} else {
	//	Ако не се е логнал някой, вмъква логин формата
		include("login/login.php");
	}
?>	