<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Skate Buddy</title>
<meta name="description" content="This is where you place a small peragraph or blurb about the sites contents">
<meta name="keywords" content="SkateBuddy, Skateboarding, Skate, Skating, Videos, Skate Videos">
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.png">
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="ie_style.css" />
<![endif]-->
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />

<script type="text/javascript" src="js/effects.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300,600,800' rel='stylesheet' type='text/css'>

<!-- This is the code for the Favicon also nown as the top icon

<link rel="icon" 
      type="image/png" 
      href="/somewhere/myicon.png" />
      
-->
</head>

<?php
require_once 'functions/functions.php';
require_once 'functions/config.php';
?>

<body>
<div id="wrapper">

<div id="window" class="shadow">

	<div id="header" class="shadow">
    <div id="user_top">
    <div class="user_picture"><img src="./images/profile_picture.png" /></div>
    <h3 class="text_shadow">Hello <?php echo get_user_firstname1(get_user_id($_SESSION["sesh"]))." ".get_user_lastname1(get_user_id($_SESSION["sesh"])) ?>!</h3>
    </div>
    <div id="search_box">
    <form action="index.php" method="post">
    <input type="submit" value="Log Out" name="submit" class="button"  />
    </form>
    </div>
      
     
    </div>
