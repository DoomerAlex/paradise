<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/vews/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/vews/css/font_awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/vews/css/style.css">
	<link rel="stylesheet" type="text/css" href="/vews/css/aside.css">

	<?php
		if($_COOKIE['color_theme'] == 'white') echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/vews/css/color_team_white.css\">"; // темная тема
		else echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/vews/css/color_team_black.css\">"; //светлая тема
	?>

	<link rel="stylesheet" media="screen and (min-width:1440px)" href="/vews/css/adaptiv_min1440.css">
	<link rel="stylesheet" media="screen and (max-width:1439px) and (min-width:1024px)" href="/vews/css/adaptiv_min1024_max1439.css">
	<link rel="stylesheet" media="screen and (max-width:1023px) and (min-width:768px)" href="/vews/css/adaptiv_min768_max1023.css">
	<link rel="stylesheet" media="screen and (max-width:767px) and (min-width:425px)" href="/vews/css/adaptiv_max767.css">
	<link rel="stylesheet" media="screen and (max-width:424px)" href="/vews/css/adaptiv_max424.css">
	<link rel="shortcut icon" href="/vews/img/favicon.png" type="/image/png">
	<title><?php echo $name_page; ?> | Paradise-lost.ru</title>
</head>
<body>
	<aside class="aside">
	<div class="aside-logo">
		<a href="/news" class="aside_img">
			<img src="/vews/img/logo.png" alt="logo" class="logo" title="На главную">
		</a>
		<a href="#" id="aside_back"><i class="fa fa-angle-double-left aside_back"></i></a>
		<hr class="aside-hr">
	</div>
	<div id="reg-buttons">
	
	<?php require_once(ROOT.FirstController::$login); ?>
	
	</div>
	<hr class="aside-hr">
	<nav class="aside-nav">
		<ul>
			<li class="aside-nav__li">
				<a href="/news/category/1" class="aside-nav__a"><i class="fa fa-futbol-o aside_icon"></i>Спорт</a>
			</li>
			<li class="aside-nav__li">
				<a href="/news/category/2" class="aside-nav__a"><i class="fa fa-flag aside_icon"></i>Политика</a>
			</li>
			<li class="aside-nav__li">
				<a href="/news/category/3" class="aside-nav__a"><i class="fa fa-rub aside_icon"></i>Экономика</a>
			</li>
			<li class="aside-nav__li">
				<a href="/news/category/4" class="aside-nav__a"><i class="fa fa-picture-o aside_icon"></i>Искусство</a>
			</li>
			<li class="aside-nav__li">
				<a href="/news/category/5" class="aside-nav__a"><i class="fa fa-users aside_icon"></i>Общество</a>
			</li>
			<li class="aside-nav__li">
				<a href="/news/category/6" class="aside-nav__a"><i class="fa fa-space-shuttle aside_icon"></i>Наука и техника</a>
			</li>
		</ul>
		<hr class="aside-hr">
	</nav>
</aside>
<div class="wrap">