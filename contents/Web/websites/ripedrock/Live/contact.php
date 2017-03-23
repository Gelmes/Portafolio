<title>South California Septic Tank Services</title>
<meta name="description" content="Feel free to contact our southern california septic tank services at 951 665-4437">
<?php include "header.php"; ?>
<div id="content">
  <script>$("#nav ul li:nth-child(6)").css('background-color','#ff9900');</script>
  <div id="top">
  
    
  
  
  
  <?php include "sidebar.php"; ?>
  <div id="contact">
  
   <?php           

//echo '<p>Please Fill In the Form Below</p>'; 
//echo '<p>'.get_permalink(11).'</p>';   
 
if(isset($_POST['submit'])) {

	if(trim($_POST['formmessage']) === '') {
		echo 'Please enter your message.<br/><br/>';
	} 
	
	
	else {	 
 
 
$to = "marcopolo1990_1@hotmail.com"; 
$subject = "Contacting Shout Out";

$name = $_POST['formname'];                
$email = $_POST['formemail'];  
$phone = $_POST['formphone'];             
$message = $_POST['formmessage'];  


$body = 
"

From: $name\n
Phone: $phone\n
Email: $email\n
Message: $message\n


"; 

//echo "Data has been submitted to $to!"; 
echo "Data has been submitted, Thank You "; 
mail($to, $subject, $body);

}
}

?>
  <h1>Contact Us</h1>
  
  <form action=""  method="post">
  <div style="width:440px;">
  <div style="float:right;">
  <h3>Phone: 951 665-4437</h3>
  <img src="images/email.jpg" width="200px"/>
  </div>
  <h3>Name:  </h3><input type="text" class="input_button" name="formname"/><br/><br/>
  <h3>Phone:  </h3><input type="text" class="input_button" name="formphone" /><br/><br/>
  <h3>Email:  </h3><input type="text" class="input_button" name="formemail" /><br/><br/>
  </div>
  <textarea class="input_button" name="formmessage" style="width:430px; height:250px; background-image:none; border:#999999 solid 1px"></textarea>
  <br/><br/>
  <input name="submit" type="submit" value="Submit" class="button">
  <input type="reset" value="Clear" class="button" />
    
  </form>
  
  
  </div>
  </div>
</div>
<?php include "footer.php"; ?>
