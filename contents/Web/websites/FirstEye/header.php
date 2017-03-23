<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FirstEye</title>
<meta name="description" content="This is where you place a small peragraph or blurb about the sites contents">
<meta name="keywords" content="keywords">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300,600,800' rel='stylesheet' type='text/css'>

<!-- This is the code for the Favicon also nown as the top icon

<link rel="icon" 
      type="image/png" 
      href="/somewhere/myicon.png" />
      
-->
<link href="css/screen.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.7.js"></script>
<script type="text/javascript" src="js/animated-background.js"></script>


<script type="text/javascript">
    $(document).ready(function(){

		
        $("#slider").easySlider({
            auto: true, 
            continuous: true,
			pause:6000,
			controlsShow: false,
		
        });
		
		
		
		
		$('#nav ul li').each(function(index) {
			$(this).click(function() {
  				//$(this).css('display','none');
				$('#sub-' + (index+1)).css('display','block');				
			});						  
									  
   			$(this).mouseover(function() {
  				//$(this).css('display','none');
				$('#sub-' + (index+1)).css('display','block');	
				//$(this).animate({height:'auto'},1000);
			});
			
			$('#sub-' + (index+1)).mouseover(function() {
				$('#sub-' + (index+1)).css('display','block');	
				//$(this).animate({height:'auto'},1000);	
			});
					
			$(this).mouseout(function() {
  				$('#sub-' + (index+1)).css('display','none');
				//$('#sub-' + (index+1)).animate({height:'0px'},1000);
								
			});
			
			$('#sub-' + (index+1)).mouseout(function() {
				//$('#sub-' + (index+1)).animate({height:'0px'},1000);
				$('#sub-' + (index+1)).css('display','none');			
			});
		});
				
		
    });	
</script>

</head>
<body>




<div id="wrapper">

	<a href = "javascript:void(0)" onclick = "$('.white_content').css('display','none'); ;document.getElementById('fade').style.display='none'"><div id="fade" class="black_overlay"></div></a>

<div id="header">
    
    
    
    <div id="nav">
    <ul>
    <li><a href="index.php">HOME</a></li>
    <li><a href="about.php">ABOUT US</a></li>
    <li>SERVICES</li>
    <li>PORTAFOLIO</li>    
    <li><a href="contact.php">CONTACT US</a></li>
    <!--<li>QUOTES</li>-->
    </ul>
    </div>    

  <ul id="sub-3" class="drop_menu" >
      <li><a href="web_services.php">WEB DESIGN</a></li>
      <li><a href="photo_services.php">PHOTOGRAPHY</a></li>    
  </ul>
    
  <ul id="sub-4" class="drop_menu">
<li><a href="web_portafolio.php">WEB DESIGN</a></li>
        <li><a href="photo_portafolio.php">PHOTOGRAPHY</a></li>    
    </ul>

        
    <div id="phone">951 665 0311</div>
    
    
</div>
