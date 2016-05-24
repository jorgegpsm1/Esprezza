<?php
	error_reporting(E_ALL);
	ini_set("session.cookie_lifetime","0");
	ini_set("session.gc_maxlifetime","0");
	@session_start();
	$_SESSION['BASE_DIR_BACKEND']	=	__DIR__;
	$_SESSION['BASE_DIR_FRONTEND']	=	'http://'. $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']);
	$_SESSION['BASE_FILE']	= basename(basename($_SERVER['SCRIPT_NAME']),'.php');
	require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/main_controller.php');
?>
