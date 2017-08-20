<?php
	// FRONT CONTROLLER
	define('ROOT', dirname(__FILE__)); // General position of file
	mb_internal_encoding("UTF-8");

	require_once(ROOT.'/components/Router.php');
	require_once(ROOT.'/components/DataBase.php');
	require_once(ROOT.'/components/Twig/Autoloader.php');

	//if (isset($_REQUEST[session_name()])) session_start();
	session_start();

	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('');
	$twig = new Twig_Environment($loader);


	$router = new Router();
	$router->run();

?>