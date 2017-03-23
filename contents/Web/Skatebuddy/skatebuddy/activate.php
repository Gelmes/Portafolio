<?php 
ob_start();
session_start();

include "elements/header.php";
include_once 'functions/config.php';
include_once 'functions/functions.php';

//Handle user if he is loged in
logged_in();

//Activating? else go away
if(empty($_GET['email']) || empty($_GET['key'])){
	header("location:index.php");	
}
	
//Clean variables and prevent SQL Injection
$email = clean_variables($_GET['email']);
$key = clean_variables($_GET['key']);

//Activate user
activate_user($email, $key);

ob_end_flush();
?>
<div id="content">

<div id="signup" class="shadow">
<div style="padding:10px;">

<h1 class="text_shadow">Thank You</h1>
<h3 class="text_shadow">Your account has been verified.</h3>
</div>
</div>

</div>

<?php include "elements/footer.php"; ?>
