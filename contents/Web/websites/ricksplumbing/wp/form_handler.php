<?php                         
 
$to = "info@ricksplumbing.net"; 
$subject = "Contacting Rick's Plumbing";

$name_field = $_POST['name'];                
$email = $_POST['email'];      
               
$phone = $_POST['phone'];  
$message = $_POST['message'];


$body = 
"

From: $name_field\n
Email: $email\n
Phone: $phone\n
message: $message\n


"; 

echo "Data has been submitted to $to!"; 
mail($to, $subject, $body);


?>