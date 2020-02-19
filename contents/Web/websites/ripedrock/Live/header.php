<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="keywords" content="keywords">
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js" type="text/javascript"></script>	
<link type="text/css" href="css/jquery-ui-1.8.24.custom.css" rel="Stylesheet" />

<link rel="icon" type="image/png" href="images/favicon.png">
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300,600,800' rel='stylesheet' type='text/css'>

<!-- This is the code for the Favicon also nown as the top icon

<link rel="icon" 
      type="image/png" 
      href="/somewhere/myicon.png" />
      
-->
<script>

$(document).ready(function(){
	

$("#header").css('display', 'none');
$("#content").css('display', 'none');
$("#footer").css('display', 'none');	
	
$("#header").fadeIn("slow", function() {

$("#content").fadeIn("slow", function() {

$("#footer").fadeIn("slow", function() {

	$("#sidebar").animate({width:'200px'}, 1000);

});

});

});


});

</script>
</head>

<body>
<div id="wrapper">

	<div id="header">
    <div id="logo"><a href="index.php"><img src="images/logo.png" alt="RipedRock Septic Tank Services Logo" height="51px" /></a></div>
    <div id="phone">951 665-4437</div>
    
    <div id="nav">
    <ul>
    <li><a href="index.php">HOME</a></li>
    <li><a href="about.php">ABOUT US</a></li>
    <li>GALLERY (Coming Soon)</li>
    <li><a href="services.php">SERVICES</a></li>
    <li><a href="septic.php">SEPTIC</a></li>
    <li><a href="contact.php">CONTACT US</a></li>
    </ul>
    </div>  
     
    </div>
