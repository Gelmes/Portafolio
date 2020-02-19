<?php include "header.php"; ?>
  <div id="content">
  
  
    <div id="contact">

    <div id="top">
     
    <div id="form">
    
    <form name="subscribeform" onsubmit="return validateOnSubmit()" method="post" action="form_handler.php">
    
    <div id="message">
    <h2>Message:</h2><textarea name="message" rows="1" cols="20"></textarea>
    
    <span><input style="padding:10px;padding-bottom:5px;padding-top:5px; width:60px; margin-top:10px;" type="submit" value="Submit"></span>
	<span><input style="padding:10px;padding-bottom:5px;padding-top:5px; width:60px; margin-left:10px; margin-top:10px;" class="button" type="reset" value="Reset"></span>
    </div>
    
    <div id="info">
    <div><h2>Name:</h2><input maxlength="40" size="25" name="name" type="text"><br /><br /></div>
    <div><h2>Email:</h2><input maxlength="40" size="25" name="email" type="text"><br /><br /></div>
    <div><h2>Phone:</h2><input maxlength="40" size="25" name="phone" type="text"><br /><br /></div>
    </div>
    
    
    
    
    </form>
    
    </div>
    
     <div id="contact_text">
     <h1>Contact Us</h1>
     <p class="style-1">We welcome your comments and questions. Please feel free to get in touch with us using the information provided below, Or you can also fill the form to the right.</p>
     </div>
     <div id="contact_info">
     <p class="style-4">
     Telephone: 1- 877-902-8638
     </p>
     <p class="style-4">
     Email: info@ricksplumbing.net
     </p>
     

     </div>
     
    </div>
    
    </div>
    

    
    <div id="bottom" style="background-image:url(images/bottom.png); height:320px; background-repeat:no-repeat; margin-top:40px;">    <div id="video"><div style="margin-left:0px; margin-bottom:0px">Brands Installed</div>
    
    <?php
  $auto = "true";  
  $images = array(
				 "images/01.jpg",
				 "images/02.jpg",
				 "images/03.jpg",
				 "images/04.jpg",
				 "images/05.jpg"
				 );
  
  
  include "gallery.php";
  ?>
    
    
    </div>
    <div id="services">
    <h1>Our Services</h1> 
    
    <p class="style-2">New Construction</p>
    <p class="style-2">Copper Repiping</p>
    <p class="style-2">Water Heaters</p>
    <p class="style-2">Water Sotteners</p>
    <p class="style-2">Water Purification Systems</p>
    <p class="style-2">Toilets & Faucets</p>
    <p class="style-2">Water Lines</p>
    <p class="style-2">Gas Lines</p>
    <p class="style-2">Sewer Service</p>
    <p class="style-2">Inspections</p>
    
    </div>
    <div id="areas">
    <h1>Service Areas</h1> 
    <p class="style-2">Fullerton</p>
    <p class="style-2">Brea</p>
    <p class="style-2">Yorba Linda</p>
    <p class="style-2">Placentia</p>
    <p class="style-2">Anaheim</p>
    <p class="style-2">Newport Beach</p>
    <p class="style-2">Irvine</p>
    <p class="style-2">Tustin</p>
    <p class="style-2">Santa Ana</p>
    <p class="style-2">Garden Grove</p>
    <p class="style-2">Laguna Niguel</p>
    <p class="style-2">Orange County</p>
    <p class="style-2">LA County</p>
    
    </div>
    
    
    
    </div>
    
  </div>
  <?php include "footer.php"; ?>
