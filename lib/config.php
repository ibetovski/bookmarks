<?php

/* База Данни */
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","bookmarks");

/* Таблици за букмарците */
define("TBL_CATEGORIES","b_categories");
define("TBL_SITES","b_sites");
define("TBL_GROUPS","b_groups");
define("TBL_USERS","b_users");
define("TBL_REMEMBERED","remembered_users");
define("TBL_COLORS","colors");

/* Активност */
define("TBL_ACTIVE_USERS","active_users");
define("TBL_ACTIVE_GUESTS","active_guests");
define("TBL_BANNED","banned_users");

/* Пътища до файловете */
define("SITE_TITLE", "Bookmarks");
define("ROOTDIR", "/Volumes/Macintosh HD/Applications/XAMPP/htdocs/bookmarks/");
define("BASEDIR", "/bookmarks/");
define("LIB_DIR",ROOTDIR . "lib/");
define("MOD_DIR",ROOTDIR . "mod/");

define('AUTHOR_WEB', "http://iliyan.eu");
define('BKM_WEB',"http://localhost/bookmarks/");

/* Where to send comments */
/*define('EMAIL_TO', "uah@abv.bg");*/
define('EMAIL_FROM', "iliyan@gnetbg.net");
define('EMAIL_FROMNAME', "Bookmarks System");
	
define("PROGRAM",1);

include(ROOTDIR . "/lib/functions.php");
include(ROOTDIR . "/lib/controller.php");

	tt_connect();
	$controller=new controller(array('page','catid','action','actionid'));
	define("CNTR_PAGE",($controller->get("page") == "" ? "list" : $controller->get("page")));
	define("CNTR_CAT",$controller->get("catid"));
	define("CNTR_ACTION",$controller->get("action"));
	define("CNTR_ACTIONID",$controller->get("actionid"));
	define("CNTR_EXTERNAL",$controller->get("external"));
	
	$template->assign("cntr_cat",CNTR_CAT);
	
include(ROOTDIR . "/lib/html.php");			//	HTML
include(ROOTDIR . "/lib/classes.php");		//	класове  и методи
include(ROOTDIR . "/lib/cls_database.php");	//	свързване с базата и всички заявки към нея
include(ROOTDIR . "/lib/cls.pages.php");	
include(ROOTDIR . "/lib/cls_session.php");	//	свързване с базата и всички заявки към нея
include(ROOTDIR . "/lib/forms.php");
	

/* page CONSTANTS */
#$uri = $_SERVER["REQUEST_URI"];
#define("EDITPAGE", (strpos($uri, "add.php") ? true : false));
	
	define("DEBUG_MODE", 1);
	function print_debug($str_debug) {
		if (DEBUG_MODE) {
			print "<div class=\"debug clearfix\">
					<h3>DEBUG</h3>";
			print "<pre>";
			print $str_debug;
			print "</pre>";
			print "</div>";
		}
	}

	
?>