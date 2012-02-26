<?php
	function html_begin($template, $title="",$page="") {
		if ($title == "")
			$title = SITE_TITLE;
		if ($title != SITE_TITLE)
			$title = SITE_TITLE . " / " . $title;
			
		?>
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
		<html>
			<head> 
				<meta name="description" content="" lang="bg-BG"> 
				<meta name="keywords" content="" lang="bg-BG"> 
				<meta http-equiv="content-type" content="text/html; charset=utf8" /> 
				<title><?=$title?></title>
				<link rel="stylesheet" type="text/css" href="<?=BASEDIR?>styles/bookmarks.css" />
				<script language="JavaScript" src="<?=BASEDIR?>scripts/jquery.js"></script>
				<script language="JavaScript" src="<?=BASEDIR?>scripts/scripts.js"></script>

				<!--[if IE]>
					<link rel="stylesheet" type="text/css" href="<?=BASEDIR?>styles/ie.css">
				<![endif]-->
				<script type="text/javascript"> 
					$(document).ready(function(){
						$(".show_colors").click(function() {
							show_colors(this);
							return false;
						});
						$(".set_color_btn").click(function() {
							set_color("<?=BASEDIR?>",this);
							hide_colors(this);
							return false;
						});
						ajax_getTitle("<?=BKM_WEB?>");
						$("#search_str").focus(function() {
							$(this).val('');
						});
						$("#clearUrl").hide();
						$("#b_url").keyup(function() {
							ajax_getTitle("<?=BKM_WEB?>");
							
						});
						$(".covering").fadeIn(500);
						$(".above_all form").animate({
							height: ['show','swing'],
						}, 300, function(){
							$(this).addClass("shown");
						});
						
						$("#clearUrl").click(clearUrl);
						$("input#cancel").click(animate_cancel);
					});
				</script>
			</head>
			<body <?=($page == "login" ? "class=\"login\"" : "class=\"inpage\"" )?>>
		<?
		if (session_is_registered("username")) {
			include(MOD_DIR . "/header.php");
		}
	}
?>