<?php
include 'config.php';

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
Function sends varification email

Returns: bool
**************************************************************************************
***************************************************************************************/
function send_confirmation($variables, $key){

	$subject = "SkateBuddy Confirmation";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= "To: $variables[first_name] <$variables[email]>" . "\r\n";
	$headers .= "From: SkateBuddy <activation@skatebuddy.rubiosweb.com>" . "\r\n";

	$body =
	"
	Thank you $variables[first_name] $variables[last_name].<br/>
	<br/>
	To confirm your account with SkateBuddy all that is left to do is ether click or go to the link below:<br/>
	<br/>
	<a href='skatebuddy.rubiosweb.com/activate.php?email=$variables[email]&key=$key'>http://www.skatebuddy.rubiosweb.com/activate.php?email=$variables[email]&key=$key</a>
	";
	$result = mail($variables['email'], $subject, $body, $headers);

	return $result;
};

/**************************************************************************************
**************************************************************************************
Send confirmatin emai

Returns: associative array
**************************************************************************************
***************************************************************************************/
function handle_confirmation ($variables) {

	//create a random key
	$key = $variables['email'] . date('mY');
	$key = md5($key);

	//add confirm row
	$confirm = mysql_query("INSERT INTO confirmations (user_key, user_email) VALUES ('$key','$variables[email]')");

	if ($confirm){
		//send the email
		if(send_confirmation($variables, $key)){
			$result = 1;
		}

	}else{$result = 0;};

	return $result;
}


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

		$new_password = md5($new_password);

		//change password
		$result = mysql_query("UPDATE users SET user_password = '$new_password' WHERE user_email = '$email' LIMIT 1") or die(mysql_error());
		if ($result){
			//delete the confirm row
			$result = mysql_query("DELETE FROM recover WHERE user_email = '$email'") or die(mysql_error());
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

	//Check for empty variables
	if($variables['first_name'] === 'First Name'){array_push($errors, 1);};
	if($variables['last_name'] === 'Last Name'){array_push($errors, 2);};
	if($variables['email'] === 'Email'){array_push($errors, 3);};
	if($variables['first_name'] === ''){array_push($errors, 1);};
	if($variables['last_name'] === ''){array_push($errors, 2);};
	if($variables['email'] === ''){array_push($errors, 3);};

	if(strstr ($variables['first_name'], ' ')){array_push($errors, 20);};
	if(strstr ($variables['last_name'], ' ')){array_push($errors, 21);};
	if(strstr ($variables['email'], ' ')){array_push($errors, 3);};

	if(empty($variables['password'])){array_push($errors, 4);};
	if(empty($variables['check_password'])){array_push($errors, 5);};
	if(empty($variables['sex'])){array_push($errors, 6);};

	if($variables['month'] == -1){array_push($errors, 7);};
	if($variables['day'] == -1){array_push($errors, 7);};
	if($variables['year'] == -1){array_push($errors, 7);};

	//Check for valid email
	if (!(strpos($variables['email'], "@") and strpos($variables['email'], "."))) {array_push($errors, 10);
	};

	//Check for valid password length
	if ((strlen($variables['password']) < 8) && !(in_array(4,$errors))){array_push($errors, 11);};

	//Check if passwords match
	if ($variables['password'] != $variables['check_password']){array_push($errors, 12);};

	return $errors;
}

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
function validate_email ($email) {
	//Check if account already exists
	$sql = "SELECT * FROM users WHERE email='$email'";
	$query = mysql_query($sql);
	if($query == 0){
		return 0;
	}
	$result = mysql_num_rows($query);
	return $result;
}

/**************************************************************************************
**************************************************************************************
Creates new user on database

Returns: associative array
**************************************************************************************
***************************************************************************************/
function create_user ($variables) {

	//encripting password
	$password = md5($variables['password']);

	//add to database
	$result =  mysql_query("INSERT INTO users (user_first_name, user_last_name, user_email, user_password, user_sex, user_birthdate, user_first_login, user_last_login, user_picture) VALUES ('$variables[first_name]', '$variables[last_name]', '$variables[email]', '$password', '$variables[sex]', '$variables[birthdate]', CURDATE(), CURDATE(), '')") or die(mysql_error());


	return $result;
}

/**************************************************************************************
**************************************************************************************
Creates new session

Returns: bool
**************************************************************************************
***************************************************************************************/
function create_session ($user_id) {

	$session = $user_id.get_user_last_login($user_id);
	$session = md5($session);

	$sql = "INSERT INTO sessions (session_id, user_id) VALUES ('$session', $user_id)";
	$result = mysql_query($sql) or die(mysql_error());

	return $session;
}

/**************************************************************************************
**************************************************************************************
Deletes new session

Returns: bool
**************************************************************************************
***************************************************************************************/
function delete_session ($user_id) {

	$sql = "DELETE FROM sessions WHERE user_id = '$user_id'";
	$result = mysql_query($sql) or die(mysql_error());

	return $result;
}

/**************************************************************************************
**************************************************************************************
used for login

Returns: associative array
**************************************************************************************
***************************************************************************************/
function validate_login ($user_email, $user_password) {

	$user_password = md5($user_password);

	//Checks database if account exists
	$sql="SELECT user_id FROM users WHERE user_email='$user_email' AND user_password='$user_password'";
	$result=mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($result) or die(mysql_error())){
		$result = mysql_fetch_assoc($result);
		$result = $result['user_id'];
	}
	else {$return = 0;};

	return $result;
}

/**************************************************************************************
**************************************************************************************
save last login time

Returns: bool
**************************************************************************************
***************************************************************************************/
function save_login_time ($user_id){

	//Checks database if account exists
	$sql="UPDATE users SET user_last_login = CURDATE() WHERE user_id = '$user_id'";
	$result=mysql_query($sql);

	return $result;
}

/**************************************************************************************
**************************************************************************************
Clean up given variables and prevent SQL injection

Returns: associative array
**************************************************************************************
***************************************************************************************/
function clean_variables($variables) {

	$type = gettype($variables);

	if ($type == 'string'){
		$variables = stripslashes($variables);
		$result = mysql_real_escape_string($variables);
	}else {
		//Cleans up variables
		foreach ($variables as $key => $value){
			$value = stripslashes($value);
			$value = mysql_real_escape_string($value);
			$result[$key] = $value;
		}

	}
	return $result;
}

/**************************************************************************************
**************************************************************************************
Activate user

Returns: associative array
**************************************************************************************
***************************************************************************************/
function activate_user($email, $key){

	//check if the key is in the database
	$key_exist = mysql_query("SELECT * FROM confirmations WHERE user_email = '$email' AND user_key = '$key' LIMIT 1") or die(mysql_error());

	if(mysql_num_rows($key_exist) != 0){

		//confirm the email and update the users database
		$update_users = mysql_query("UPDATE users SET user_active = 1 WHERE user_email = '$email' LIMIT 1") or die(mysql_error());
		//delete the confirm row
		$delete = mysql_query("DELETE FROM confirmations WHERE user_email = '$email'") or die(mysql_error());
	}


}

/**************************************************************************************
**************************************************************************************
Is the user with the give email active

Returns: string
**************************************************************************************
***************************************************************************************/
function user_active ($user_id) {
	$sql = "SELECT * FROM users WHERE user_id='$user_id' AND user_active=1";
	$result = mysql_query($sql);
	$active = mysql_num_rows($result);
	return $active;
}

/**************************************************************************************
**************************************************************************************
Handle the user if he is already loged in to keep him away from
main signup page, login page, activate page, reset page etc...

Returns: string
**************************************************************************************
***************************************************************************************/
function logged_in () {
	//$email = clean_variables($_SESSION["email"]);

	//If user is loged in send him to his page
	//But if user is not active send him to activate his account
	if (isset($email)){
		header("location:feed.php");
	}

}

/**************************************************************************************
**************************************************************************************
Handle the user if he is loged out

Returns: string
**************************************************************************************
***************************************************************************************/
function logged_out () {

	//$email = clean_variables($_SESSION["email"]);

	//If user is loged in send him to his page
	//But if user is not active send him to activate his account
	if (!$_SESSION["sesh"]){
		header("location:index.php");
	}elseif ($_SESSION["sesh"] && !user_active(get_user_id($_SESSION["sesh"]))){
		header("location:confirm.php");
	}
}

/**************************************************************************************
**************************************************************************************
Get user first name

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_firstname($email) {

	$sql = "SELECT user_first_name FROM users WHERE user_email = '$email'";
	$result = mysql_query($sql);
	$name = mysql_fetch_assoc($result);

	return $name["user_first_name"];
}

/**************************************************************************************
**************************************************************************************
Get user last name

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_lastname($email) {

	$sql = "SELECT user_last_name FROM users WHERE user_email = '$email'";
	$result = mysql_query($sql);
	$name = mysql_fetch_assoc($result);

	return $name["user_last_name"];
}

/**************************************************************************************
**************************************************************************************
Get user contacts

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_contacts($email) {

	$sql = "SELECT contact_email,contact_firstname,contact_lastname FROM contacts WHERE user_email = '$email'";
	$result = mysql_query($sql);
	$contacts = array();
	while ($contact = mysql_fetch_assoc($result)){
		array_push($contacts,$contact);
	}

	return $contacts;
}


/**************************************************************************************
**************************************************************************************
Get user id

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_id($session_id) {

	$sql = "SELECT user_id FROM sessions WHERE session_id = '$session_id'";
	$result = mysql_query($sql) or die('Invalid Session: 551');
	$user_id = mysql_fetch_assoc($result);
	$user_id = $user_id['user_id'];

	return $user_id;
}



/**************************************************************************************
**************************************************************************************
Get user first name

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_firstname1($user_id) {

	$sql = "SELECT user_first_name FROM users WHERE user_id = '$user_id'";
	$result = mysql_query($sql) or daie('Invalid Session: 552');
	$name = mysql_fetch_assoc($result);

	return $name["user_first_name"];
}

/**************************************************************************************
**************************************************************************************
Get user last name

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_lastname1($user_id) {

	$sql = "SELECT user_last_name FROM users WHERE user_id = '$user_id'";
	$result = mysql_query($sql) or die('Invalid Session: 552');
	$name = mysql_fetch_assoc($result);

	return $name["user_last_name"];
}

/**************************************************************************************
**************************************************************************************
Get user contacts

Returns: string
**************************************************************************************
***************************************************************************************/
function get_user_contacts1($user_id) {

	$sql = "SELECT contact_id FROM contact WHERE user_id = '$user_id'";
	$result = mysql_query($sql) or die('Invalid: 553');
	$contacts = array();
	while ($contact = mysql_fetch_assoc($result)){
		array_push($contacts,$contact['contact_id']);
	}

	return $contacts;
}



/**************************************************************************************
**************************************************************************************
Gets last login date

Returns: bool
**************************************************************************************
***************************************************************************************/
function get_user_last_login ($user_id) {

	$sql = "SELECT user_last_login FROM users WHERE user_id = $user_id";
	$result = mysql_query($sql) or die(mysql_error());
	$result = mysql_fetch_assoc($result);

	return $result['user_last_login'];
}


/**************************************************************************************
**************************************************************************************
Create a new conversation

Requires: User1, User2
Returns: int
**************************************************************************************
***************************************************************************************/
function create_conversation($user1, $user2) {

	$sql = "INSERT INTO conversations (user1, user2) VALUES ('$user1', '$user2')";
	$result = mysql_query($sql);

	return $result;

}

/**************************************************************************************
**************************************************************************************
Create a new message

Requires: from, to, message
Returns: Bool
**************************************************************************************
***************************************************************************************/
function create_message($from, $to, $message) {

	$sql = "INSERT INTO messages (from_user, to_user, message) VALUES ($from, $to, '$message')";
	$result = mysql_query($sql) or die(mysql_error());
	return $result;

}

/**************************************************************************************
**************************************************************************************
Get messages

Requires: for_user
Returns: Bool
**************************************************************************************
***************************************************************************************/
function get_messages_for($for_user) {

	$sql = "SELECT * FROM messages WHERE to_user = $for_user";
	$result = mysql_query($sql) or die(mysql_error());
	$messages = array();
	while ($message = mysql_fetch_assoc($result)){
		array_push($messages,$message);
	}
	return $messages;

}

/**************************************************************************************
**************************************************************************************
Get latest message

Requires:
Returns: Bool
**************************************************************************************
***************************************************************************************/
function get_last_message_for($for_user) {

	$sql = "SELECT * FROM messages WHERE to_user = $for_user ORDER BY date_sent DESC LIMIT 1";
	$result = mysql_query($sql) or die(mysql_error());
	$message = mysql_fetch_assoc($result);
	return $message;

}


?>
