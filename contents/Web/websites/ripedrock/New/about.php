<title>About Ripedrock Septic Services</title>
<meta name="description" content="We are your COMPLETE SEPTIC TANK SERVICE company for southern California.!">

<?php include "header.php"; ?>
<div id="content">
  <script>$("#nav ul li:nth-child(2)").css('background-color','#ff9900');</script>
  <div id="top">
  <!--<script>
  
   $(document).ready(function(){
   
   /*
   Had to write this code as a work around since the
   css for sidebar height did not work:
   
   #sidebar{
	   height 100%;	   
   }
   
   */
   var sidebar_multiply = 1.5; //How much bigger side bar should be then the content
   var height = $("#about").css("height"); //Gets the height of the content
   
   //Converts the Height of the content to an Intiger
   //Then multiplys it by the sidebar_multiply.
   height = height.slice(0, -2); //extracts only the intiger part of the string
   height = parseInt(height); //String to Int
   height = height*sidebar_multiply; //Multiplys the height
   
   var sidebar_height = height + "px"; //Adds "px" for pixles and converts Int to String
   $("#sidebar").css("height",sidebar_height); //Sets the Sidebar Height Dynamicaly based on Content 
   
   });
  
  </script>-->
  <?php include "sidebar.php"; ?>
  <div id="about"> 
  
  <div>
  <h1>About Us</h1><br>
  
<p>We are your <em>COMPLETE SEPTIC TANK SERVICE</em> company for southern California.!</p><br>

<p>We would like to thank you for browsing our company. We, at all times, will attempt to give you prompt, courteous and professional service. Please review our site to find how we can help you!</p><br>

<p>As septic contractor we are able to offer the best solution for any septic system you may need, including, 24-hour emergency septic tank pumping fast and professional installation, and a complete line of septic system  products.</p><br>

<p>Visit our gallery  see some of the work we have done, then call <em>24/7</em> (951) 665-4437  and let us show you what we can do!</p><br>
</div>

	<div id="links">
    <h1>Some Useful Links</h1>
    <a href="http://cfpub.epa.gov">E.P.A.</a><br>
    <a href="http://nesc.wvu.edu/">The National Environmental Services Center</a><br>
    <a href="http://www.rivcoeh.org/opencms/system/galleries/download/Environmental-Health/ERM/OWTS_Installation_Guide.pdf"> Onsite Wastewater 
Treatment Systems</a><br>
    <a href="http://www.epa.gov/owm/septic/pubs/homeowner_guide_long.pdf">A Home Owners Guide To Septic Systems</a>
    </div>

</div>
  
  
  
  
  </div>
</div>
<?php include "footer.php"; ?>
