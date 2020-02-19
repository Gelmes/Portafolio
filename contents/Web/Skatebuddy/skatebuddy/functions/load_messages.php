<?php
ob_start();
session_start();

include_once 'functions.php';
include_once 'config.php';

//Handle user if he is loged out
logged_out();

//Get basic user info
$user_id = get_user_id($_SESSION["sesh"]);
$contacts = get_user_contacts1($user_id);

//Who is this message being sent to
$to = clean_variables($_POST["to"]);

for ($i=0;$i<(count($contacts));$i++){
	
	$contact_firstname = get_user_firstname1($contacts[$i]);
	$contact_lastname = get_user_lastname1($contacts[$i]);
	
	$contact_name = explode(" ",$to);
	$result = false;
	foreach ($contact_name as $value){
		if($value){			
			$result = 0===(strpos(strtolower($contact_firstname), strtolower($value)));		
			if (($result === false)){			
				$result = 0===(strpos(strtolower($contact_lastname), strtolower($value)));
			}
		}
	}	
	if (!($result === false)){
		echo "<div>".$contact_firstname." ".$contact_lastname."</div>";
	}
}	  

ob_end_flush();
?>





