<?php                         
 
$to = "marcopolo1990_1@hotmail.com"; 
$subject = "*----- First Eye -----*";

$name = $_POST['name'];                
$email = $_POST['email'];  
$phone = $_POST['phone'];             
$message = $_POST['message'];  


$body = 
"

From: $name\n
Phone: $phone\n
Email: $email\n
Message: $message\n


"; 

echo "Data has been submitted to $to!"; 
mail($to, $subject, $body);


?>