<?php 
/*************************************************************************************
Reset password page.

If someone gets to this page they must have a key and an email else
they will be redirected to the home page.
*************************************************************************************/

ob_start();
session_start();

include "elements/header.php";
include_once 'functions/config.php';
include_once 'functions/functions.php';
	
//Handle user if he is loged in
logged_in();	


//Clean variables and prevent SQL injection	
$user_email = clean_variables($_GET['email']); 
$key = clean_variables($_GET['key']);

//Find if user has requested passeword recovery
$check_key = mysql_query("SELECT * FROM recover WHERE user_email='$user_email' AND user_key='$key'") or die(mysql_error());

if(mysql_num_rows($check_key)){

	if (isset($_POST['submit'])){			
		
		//Clean variables and prevent SQL injection	
		$new_password = clean_variables($_POST['new_password']); 
		$new_password_check = clean_variables($_POST['new_password_check']);
				
		//Passwords must be at least 8 characters long
		//The password must match the password check
		if (strlen($new_password) > 8){
			if ($new_password == $new_password_check){					
				//If password reset succesful user will be redirected
				$result = update_password($user_email, $key, $new_password);	
				header("location:login.php?recovered=1");
			}else {
				$error = 2;			
			};
		}else{
			$error = 1;			
		}
		
	};
	
}else{	
	//Redirect user if email does not excist
	header("location:index.php");	
}
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
if ($error){
		  echo '<style>#password{border:#ff0000 solid 2px;}</style>';
		  echo '<style>#password_check{border:#ff0000 solid 2px;}</style>';
		  if($error == 1){
		  	echo 'Passwords too short at least 8 characters.<br/>';
		  }
		  if($error == 2){
		  	echo "Passwords don't match.";
		  }
};
?>
</div>
<form action="" method="post">
<div class="field_div">
Reset Password:<br/>
<input id="password" type="password" name="new_password" class="input_field"/> 
</div>
<div class="field_div">
Reenter Password:<br/>
<input id="password_check" type="password" name="new_password_check" class="input_field"/> 
</div>

<div class="field_div">
<input type="submit" value="Submit" name="submit" class="button">
</div>
</form>
</div>
</div>
</div>

<?php include "elements/footer.php"; ?>
