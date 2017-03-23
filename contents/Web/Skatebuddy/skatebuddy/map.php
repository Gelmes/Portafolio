<?php 
//Is user loged in? if not go to main page
session_start();
if(!isset($_SESSION["email"])){header("location:index.php");};

include "elements/user_header.php";
include_once 'functions/config.php';
include_once 'functions/functions.php';
include "js/map_controller.php"; 

//Handle user if he is loged out
logged_out();
?>

<div id="content">
	<?php include "elements/sidebar.php"; ?>
	<div id="map_canvas" style="width:100%; height:100%"></div> 
 </div> 
  
</div><!-- Window -->

<?php include "elements/footer.php"; ?>
