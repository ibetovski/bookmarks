<?php
	
	include("../lib/config.php");

	$session = new session;
	$session->destroy_user_session();
	session_start();
	session_destroy();
	header("Location: " . BASEDIR);
?>