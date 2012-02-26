<?php
	if (!defined("PROGRAM")) {
		exit;
	}
	
	include(ROOTDIR . "/login/login_check.php");
	include(ROOTDIR . "/lib/page_obj.php");
	html_begin($template,"Списък");
	$db_websites = new db_websites;
	$categories = new categories;
	if (CNTR_PAGE == "search") {
		$search_str=CNTR_CAT;
		$template->assign("mod_title","Търсене");
	} elseif (CNTR_CAT == "" || CNTR_CAT == 0) {
		$template->assign("mod_title","Последно добавени");
	}
	
	$websites = $db_websites->get_bookmarks($search_str);
	$user_categories = $categories->get_user_categories();
	$cnt_bkm = $db_websites->cnt_bkm;
	
	$colors = $db_websites->get_colors();
	
	$template->assign("websites",$websites);
	$template->assign("user_cats",$user_categories);
	$template->assign("cnt_bkm",$cnt_bkm);
	$template->assign("total_pages",$db_websites->total_pages);
	$template->assign("page_link",BASEDIR . CNTR_PAGE . "/".(CNTR_CAT == "" ? 0 : CNTR_CAT). "/page/");
	$template->assign("cur_page",(CNTR_ACTIONID == "" ? 1 : CNTR_ACTIONID));
	$template->assign("list_start_number",$db_websites->list_start_number+1);
	$template->assign("colors",$colors);
	
	/* екстенжъна за хром подава URL-то с ескейпнати наклонени черти заради контролера */
	if (CNTR_PAGE == "add" && CNTR_CAT == 0 && (preg_match("/^http:/",CNTR_ACTION) == true)) {
		$b_url = preg_replace("/__url_slash__/","/",preg_replace("/__url_and__/","&",CNTR_ACTION));
		$template->assign("b_url",$b_url);
	}
	
	$forms = new addForm;
	$template->register_object("forms",$forms,null,false);
	$template->assign("catid",CNTR_CAT);
	if ($_POST || isset($_POST["edit"]) || isset($_POST["add"])) {
		if ($_POST["edit"] || $_POST["action"] == "edit") {
			$action = "edit";
			$edited_item = $db_websites->get_edited_item($_POST["bid"]);
			extract($edited_item);
			foreach($edited_item as $key => $val) {
				if (!is_numeric($key)) {
					$template->assign($key,$val);
				}
			}
		} else {
			$action = "add";
		}
		$template->assign("action",$action);
		include(LIB_DIR . "fnc.bmk_post.php");
	}
	$template->display("page.list.tpl");
	
	include(MOD_DIR."/footer.php");
	#html_end($str_debug);
?>
