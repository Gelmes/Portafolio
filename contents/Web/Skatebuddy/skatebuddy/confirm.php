<?php 
ob_start();
session_start();

include "elements/header.php";
include_once 'functions/config.php';
include_once 'functions/functions.php';

//Handle user if he is loged in
logged_in();

if(isset($_POST['submit'])){
	//Clean up variables and prevent SQL injection
	$email = clean_variables($_POST['email']);
	
	//Get user details
	$valid = validate_email($email);
	//Does user exist?
	if($valid){
		$user_exist = 1;
	}else{
		$user_exist = 2;		
	}
	
	//Has the user activated his account?
	if(user_active($email)){
		$user_active = 1;		
	}else {$user_active = 0;}	
}
ob_end_flush();
?>

<div id="content">

<div id="signup" class="shadow">
<div style="padding:10px;">
<h1 class="text_shadow">Activate account</h1>
<div class="field_div">Confirm your account before logging in for the first time. If you did not recive an email from us, enter your account email to resend you another confirmation email.
</div>
<div class="field_div">
<?php 
if (isset($user_exist)){
	if ($user_exist == 1){
		echo "An email verification has been resent to '$email'.";
	}elseif($user_exist == 2) {	
		echo "Email '$email' does not exist. <a href='index.php'>Sign up?</a>";
	}	
}
if (isset($user_active)){
	if ($user_active){
		echo "Email '$email' is already in activated.<a href='recover.php'>Forogt your password?</a>";
	}
};
?>

</div>
<div class="field_div">
<form action="" method="post">
Email:
<input type="text" id="email" class="input_field" name="email" />
<input type="submit" value="Resend" name="submit" class="button" />

</form>
</div>
</div>
</div>

</div>

<?php include "elements/footer.php"; ?>
