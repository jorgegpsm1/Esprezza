<?php
//	Reportar Errores
	error_reporting(E_ALL);

// 	Seteo de coockies 
	ini_set("session.cookie_lifetime","0");
	ini_set("session.gc_maxlifetime","0");

// Inicio de session
	@session_start();

// Inicializacion de variables de rutas
	$_SESSION['BASE_DIR_BACKEND']	=	__DIR__;
	$_SESSION['BASE_DIR_FRONTEND']	=	'http://'. $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']);
	$_SESSION['BASE_FILE']	= basename(basename($_SERVER['SCRIPT_NAME']),'.php');

//	Inicializacion de controlador principal/
	require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/main_controller.php');
?>
