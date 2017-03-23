<?php
include 'config.php';

/***************************************************************************************
**************************************************************************************
Function sends varification email

Returns: bool
**************************************************************************************
***************************************************************************************/
function send_email($user_first_name, $user_last_name, $user_id, $user_key, $user_email){
	
	$subject = "SkateBuddy Confirmation";
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= "To: $user_first_name <$user_email>" . "\r\n";
	$headers .= "From: SkateBuddy <activation@skatebuddy.rubiosweb.com>" . "\r\n";
	
	$body = 
	"	
	Thank you $user_first_name $user_last_name.<br/>
	<br/>
	To confirm your account with SkateBuddy all that is left to do is ether click or go to the link below:<br/>
	<br/>
	<a href='skatebuddy.rubiosweb.com/activate.php?email=$user_email&key=$user_key'>http://www.skatebuddy.rubiosweb.com/activate.php?email=$user_email&key=$user_key</a>
	"; 
	$result = mail($user_email, $subject, $body, $headers);
	return $result;
};

/***************************************************************************************
**************************************************************************************
Function sends password reset link

Returns: bool
**************************************************************************************
***************************************************************************************/
function send_recovery($user_email){
	
	$key = $user_email.date('c');
	$key = md5($key);
	
	$result = mysql_query("INSERT INTO recover (user_email, user_key, date) VALUES ('$user_email', '$key', CURDATE())");
	
	if ($result){
		$subject = "SkateBuddy Password Recovery";
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= "To: $user_first_name <$user_email>" . "\r\n";
		$headers .= "From: SkateBuddy <recover@skatebuddy.rubiosweb.com>" . "\r\n";
		
		$body = 
		"	
		$user_first_name $user_last_name.<br/>
		<br/>
		Click or copy the link below to reset your password:<br/>
		<br/>
		<a href='skatebuddy.rubiosweb.com/reset.php?email=$user_email&key=$key'>http://www.skatebuddy.rubiosweb.com/reset.php?email=$user_email&key=$key</a>
		"; 
		$result = mail($user_email, $subject, $body, $headers);
	}
	
	return $result;
};

/***************************************************************************************
**************************************************************************************
Function sends password reset link

Returns: bool
**************************************************************************************
***************************************************************************************/
function update_password($email, $key, $new_password){
	
	$result = 0;
	$check_key = mysql_query("SELECT * FROM recover WHERE user_email = '$email' AND user_key = '$key'") or die(mysql_error());	
	
	if (isset($check_key)){
		
		$confirm_info = mysql_fetch_assoc($check_key);
		
		$new_password = md5($new_password);
		
		//change password
		$result = mysql_query("UPDATE users SET user_password = '$new_password' WHERE user_email = '$confirm_info[user_email]' LIMIT 1") or die(mysql_error());
		if ($result){	
			//delete the confirm row
			$result = mysql_query("DELETE FROM recover WHERE user_email = '$confirm_info[user_email]'") or die(mysql_error());
		}
	}
	
	return $result;
};

/**************************************************************************************
**************************************************************************************
Function that checks for valid values
The returned variable contains an array
of error codes

Returns: array of int values
**************************************************************************************
***************************************************************************************/
function check_variables($variables){
	
	$errors = array();

	//Clean Variables
	//Prevent msql injection
	$user_first_name = ($_POST['user_first_name']); 
	$user_last_name = ($_POST['user_last_name']);
	$user_email = ($_POST['user_email']);
	$user_password = ($_POST['user_password']);
	$check_password = ($_POST['check_password']);
	$user_sex = ($_POST['user_sex']);
	$user_birthday_month = ($_POST['user_birthday_month']);
	$user_birthday_day = ($_POST['user_birthday_day']);
	$user_birthday_year = ($_POST['user_birthday_year']);
	
	$user_first_name = stripslashes($user_first_name); 
	$user_last_name = stripslashes($user_last_name);
	$user_email = stripslashes($user_email);
	$user_password = stripslashes($user_password);
	$check_password = stripslashes($check_password);
	$user_sex = stripslashes($user_sex);
	$user_birthday_month = stripslashes($user_birthday_month);
	$user_birthday_day = stripslashes($user_birthday_day);
	$user_birthday_year = stripslashes($user_birthday_year);
	
	$user_first_name = mysql_real_escape_string($user_first_name); 
	$user_last_name = mysql_real_escape_string($user_last_name);
	$user_email = mysql_real_escape_string($user_email);
	$user_password = mysql_real_escape_string($user_password);
	$check_password = mysql_real_escape_string($check_password);
	$user_sex = mysql_real_escape_string($user_sex);
	$user_birthday_month = mysql_real_escape_string($user_birthday_month);
	$user_birthday_day = mysql_real_escape_string($user_birthday_day);
	$user_birthday_year = mysql_real_escape_string($user_birthday_year);
	
	//Check for empty variables
	if($user_first_name === 'First Name'){array_push($errors, 1);};
	if($user_last_name === 'Last Name'){array_push($errors, 2);};
	if($user_email === 'Email'){array_push($errors, 3);};
	if($user_first_name === ''){array_push($errors, 1);};
	if($user_last_name === ''){array_push($errors, 2);};
	if($user_email === ''){array_push($errors, 3);};
	
	if(strstr ($user_first_name, ' ')){array_push($errors, 1);};
	if(strstr ($user_last_name, ' ')){array_push($errors, 2);};
	if(strstr ($user_email, ' ')){array_push($errors, 3);};
	
	if(empty($user_password)){array_push($errors, 4);};	
	if(empty($check_password)){array_push($errors, 5);};
	if(empty($user_sex)){array_push($errors, 6);};	
	
	if($user_birthday_month == -1){array_push($errors, 7);};	
	if($user_birthday_day == -1){array_push($errors, 7);};
	if($user_birthday_year == -1){array_push($errors, 7);};
	
	//Check for valid email
	if (!(strpos($user_email, "@") and strpos($user_email, "."))) {array_push($errors, 10);
	};
	
	//Check for valid password length
	if (strlen($user_password) < 8){array_push($errors, 11);};
	
	//Check if passwords match
	if ($user_password != $check_password){array_push($errors, 12);};
	
	//Check for correct birth yeah
	if ($user_birthday_year < (date('Y') - 7)){
		$user_birthdate = $user_birthday_month."/".$user_birthday_day."/".$user_birthday_year;
	}else{
		array_push($errors, 13);
	}
	
	return $errors;
};

/**************************************************************************************
**************************************************************************************
Function returns a string containing a string 
containing html of any updates or news posted 
by the friends of the user.

Returns: string
**************************************************************************************
***************************************************************************************/
function get_feed () {
	
	$feed = "Updates";	
	return $feed;	
}

/**************************************************************************************
**************************************************************************************
Function returns a an array with the users information

Returns: associative array
**************************************************************************************
***************************************************************************************/
function get_user ($user_email) {		
	//Check if account already exists
	$sql = mysql_query("SELECT * FROM users WHERE user_email='$user_email'");
	$count = mysql_num_rows($sql);
	if ($count == 1){
		$return = mysql_fetch_assoc($sql);
	}else{
		$return = 0;
	};
	return $result;
}

/**************************************************************************************
**************************************************************************************
Function returns a an array with the users information

Returns: associative array
**************************************************************************************
***************************************************************************************/
function validate_user ($user_email, $user_password) {	
		
	$user_password = md5($user_password);
	
	//Checks database if account exists
	$sql="SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password'";
	$result=mysql_query($sql);
	$result=mysql_num_rows($result);
	
	return $result;	
}

/**************************************************************************************
**************************************************************************************
Function cleans up variables

Returns: associative array
**************************************************************************************
***************************************************************************************/
function clean_variables($array) {	
		
	$result = array();
	
	//Cleans up variables
	foreach ($array as $key => $value){
		$value = stripslashes($value);
		$value = mysql_real_escape_string($value);
		
		$result[$key] = $value;		
	}
	
	return $result;	
}





?>