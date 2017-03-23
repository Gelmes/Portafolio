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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300,600,800' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/coin-slider.min.js"></script>
<link rel="stylesheet" href="<? bloginfo('stylesheet_directory'); ?>/css/coin-slider-styles.css" type="text/css" />
<link rel="stylesheet" href="<? bloginfo('stylesheet_directory'); ?>/css/style.css" type="text/css" />
<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js">

/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


<script type="text/javascript">

animatedcollapse.addDiv('package-1', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('package-2', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('package-3', 'fade=0,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>
-->
<?php  wp_head(); ?>
</head>

<body>
<div id="wrapper">

	<div id="header">
    <div id="logo">
    <a href="<? bloginfo('home'); ?>"><img src="<?php echo get_option('of_logo') ?>" alt="<? bloginfo('name'); ?>" height="147" /></a>
    </div>
    <div id="menu">
    <a href="<? bloginfo('home'); ?>">Home</a> | <a href="/wearventana/wp/teams/">Teams & Clubs</a> | <a href="/wearventana/wp/events/">Events</a> | <a href="/wearventana/wp/retail/">Retail</a> | <a href="/wearventana/wp/about/">About Us</a> | <a href = "javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';">Contact Us</a></div>
</div>