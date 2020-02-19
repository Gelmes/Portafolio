<?php
/*************************************************************************************
Handle reroutes & login attempts
*************************************************************************************/
ob_start();
session_start();

//Checks if user is already loged in
if (isset($_SESSION["email"])){
	header("location:feed.php");	
}

//Checks for multiple login attemps 
if (isset($_SESSION["attempt"])){
	$_SESSION["attempt"] += 1;
}

//If no login attempts set the first attempt
else{$_SESSION["attempt"] = 1;}



include "elements/login_header.php"; 
include_once 'functions/config.php';
include_once 'functions/functions.php';
require_once 'functions/recaptchalib.php';

/*************************************************************************************
Begin form handling
*************************************************************************************/

$errors = array();

//Login attempts allowed
$attempts = $_SESSION["attempt"];
$attempts_allowed = 3;

//Captcha Variables
$publickey = "6LfCndsSAAAAAEUH3K4XYWNaRea9vGUD5wJOUeH3";
$privatekey = "6LfCndsSAAAAABwFRB4vms_lq6RH2gXOgRi4F7H5";

//Check form submition
if (isset($_POST['submit'])) {
	
	//If the user logs in too many times check caatcha
	if ($attempts > ($attempts_allowed + 1)){
		//Was captcha entered correctly?
		$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);
		$resp = $resp->is_valid;
	}else {$resp = 1;}
	
	//Clean up variables
	$email = clean_variables($_POST['email']); 
	$password = clean_variables($_POST['password']);
	
	//Does user exist?
	$result = validate_login($email, $password);	
	
	//If user exists and captcha is correct login
	if($result && ($resp)){
		$_SESSION["email"] = $email;
		header("location:feed.php");
	}elseif ($resp){
		array_push($errors, 301);		
	}
	
	//Was captcha entered correctly?
	if(!$resp){
		array_push($errors, 302);	
	}
};
ob_end_flush();
?>

<div id="content">

<div id="login" class="shadow">
<div style="padding:10px;">

<div>
<h1 class="text_shadow">Login</h1>
<h3 class="text_shadow"><?php if (in_array(301, $errors)){echo 'Wrong email or password.<br/>';};?></h3>
</div>

<div class="field_div">
<?php
if (in_array(301, $errors)){
		  echo '<style>#login_email{border:#ff0000 solid 2px;}</style>';
		  echo '<style>#login_password{border:#ff0000 solid 2px;}</style>';
		  echo '<a href="recover.php">Forgor your password? </a><br/><a href="index.php">Sign Up for SkateBuddy? </a>';
};
if (isset($_GET['recovered'])){
		  echo 'You have succesfully reset your password';
};
?>
</div>

<form action="" method="post">
<div class="field_div">Email:<br/><input id="login_email" type="text" name="email" class="input_field"/> </div>
<div class="field_div">Password:<br/><input id="login_password" type="password" name="password" class="input_field"/></div>

<div class="field_div">
<?php
if ($attempts > $attempts_allowed){	
	if (in_array( 302, $errors)){				 
		  echo 'You have entered the wrong capacha.';				 
	}	
	echo recaptcha_get_html($publickey);	
};
?>
</div>

<div class="field_div"><input type="submit" value="Submit" name="submit" class="button"></div>
</form>

</div>

</div>  
  
</div><!-- Content -->

<?php include "elements/footer.php"; ?>
