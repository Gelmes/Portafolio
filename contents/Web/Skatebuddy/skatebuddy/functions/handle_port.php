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

//Check if we have a contact list to deliver to
if(!isset($_SESSION['list'])){$_SESSION['list']= array();}

for ($i=0;$i<(count($contacts));$i++){
	
	if (!in_array($contacts[$i], $_SESSION['list'])){
		$contact_id = $contacts[$i];
		$contact_firstname = get_user_firstname1($contact_id);
		$contact_lastname = get_user_lastname1($contact_id);
		
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
			echo "<div onclick(\"handle_contact($contact_id)\");>".$contact_firstname." ".$contact_lastname."</div>";
				array_push ($_SESSION['list'], $contacts[$i]);
		}
	}
}	  

ob_end_flush();
?>





