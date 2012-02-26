<?php
	if (!session_is_registered("username")) {
		header("Location: " . BASEDIR);
	}
	
	/*
	if (!isset($_SESSION["userid_str"])) {
		header("Location: " . BASEDIR);
	}*/
?>