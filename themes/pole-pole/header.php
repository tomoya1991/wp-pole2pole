<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="keywords" content="">
<meta name="description" content="">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

<meta property="og:locale" content="">
<meta property="og:site_name" content="">
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:url" content="">
<meta property="og:type" content="">
<meta name="twitter:site" content="">
<meta name="twitter:title" content="">
<meta name="twitter:card" content="">
<meta name="twitter:url" content="">
<meta name="twitter:description" content="">
<meta name="twitter:image" content="">

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/import.css" type="text/css" media="screen" />
<link href="https://fonts.googleapis.com/css?family=Yantramanav:300" rel="stylesheet"><!--グーグルフォント-->

<body>

<header>
	<h1><a href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/header_log.png" width="50" height="50" alt="ロゴ"></a></h1>
	<nav>
		<ul>
			<li><a href="<?php echo get_home_url(); ?>/works/" title="">WORKS</a></li>
			<li><a href="<?php echo get_home_url(); ?>/exhibitions/" title="">ARCHIVE</a></li>
			<li><a href="<?php echo get_home_url(); ?>/about/" title="">ABOUT</a></li>
		</ul>
	</nav>
	<!-- <p id="lng"><a class="en">English</a><span id="divi">/</span><a class="ja">日本語</a></p>-->
	<a id="nav_btn">☰</a> 
</header>

<div id="nav_mob_layer"></div>

<div id="wrapper">
<hr>
