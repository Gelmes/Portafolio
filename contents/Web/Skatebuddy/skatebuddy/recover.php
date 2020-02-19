<?php
ob_start();
session_start();

include "elements/header.php";
include_once 'functions/config.php';
include_once 'functions/functions.php';

//Handle user if he is loged in
logged_in();

/*************************************************************************************
Find user and send recovery email
*************************************************************************************/

if (isset($_POST['submit'])){
	
	//Clean Variables and prevent SQL injection	
	$email = clean_variables($_POST['email']); 	
	
	//Sending recovery email
	$result = send_recovery($email);
	
};
ob_end_flush();

?>

<div id="content">
<div id="login" class="shadow">

<div style="padding:10px;">

<div>
<h1 class="text_shadow">Reset Password</h1>
<h3 class="text_shadow">

</h3>
</div>
<div class="field_div">
<?php 
if ($result){
	echo "<div style='padding:20px;text-align:center;'><h3 class='text_shadow'>A recovery link has been sent to '$email'.</h3></div>";
}else{ 
	echo "Type your email address to send you a recovery link.";
}
?>
</div>
<form action="" method="post" <?php if($result){echo 'style="display:none;"';}; ?>>
<div class="field_div">
Email:<br/>
<input id="email" type="text" name="email" class="input_field"/> 
</div>

<div class="field_div">
<input type="submit" value="Submit" name="submit" class="button">
</div>
</form>
</div>
</div>
</div>

<?php include "elements/footer.php"; ?>
