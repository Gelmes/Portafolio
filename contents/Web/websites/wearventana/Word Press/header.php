<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php wp_title('&laquo;', true, 'right'); ?>
<?php bloginfo('name'); ?>
</title>
<!-- Main WordPress Stylesheet -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!-- WYSIWYG CSS -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/wysiwyg.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link href="<? bloginfo('stylesheet_directory'); ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300,600,800' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<? bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<? bloginfo('stylesheet_directory'); ?>/js/coin-slider.min.js"></script>
<link rel="stylesheet" href="<? bloginfo('stylesheet_directory'); ?>/css/coin-slider-styles.css" type="text/css" />

<?php  wp_head(); ?>
</head>

<body>
<div id="wrapper">

	<div id="header">
    <?php wp_nav_menu(array( 'container_id' => 'menu' ) ); ?>
    <div id="logo">
    <a href="<? bloginfo('home'); ?>"><img src="<? bloginfo('stylesheet_directory'); ?>/images/logo.png" /></a>
    </div>
    <div id="menu"><a href="index.php">Home</a> | <a href="teams.php">Teams & Clubs</a> | <a href="events.php">Events</a> | <a href="retail.php">Retail</a> | <a href="about.php">About Us</a> | <a href = "javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';">Contact Us</a></div>
</div>
