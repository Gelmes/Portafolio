<?php
/*
Template Name: Gallery
*/
?>

<? get_header(); ?>
  <div id="content">
  
  
    <div id="faq" class="white_back">
    
    <div id="top">
      
      
  



    <link href="<?php bloginfo('stylesheet_directory'); ?>/css/screen.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easySlider1.7.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				controlsShow:	false,
				pause:			3000,
			});
		});	
	</script>

		
		<div id="slider">
			<ul>
            
<? $gallery = get_option('of_gallery') ?>
  <?php query_posts('category_name='.$gallery.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
  
<li><?php the_content(); ?></li>

<?php endwhile;?>             
            
			</ul>
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
<? get_footer(); ?>
