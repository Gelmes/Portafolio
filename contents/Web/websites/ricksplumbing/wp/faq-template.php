<?php
/*
Template Name: Gallery
*/
?>

<? get_header(); ?>
  <div id="content">
  
  
    <div id="faq" class="white_back">
    
    <div id="top">
      
      
  



    <link href="<?php bloginfo('stylesheet_directory'); ?>/css/gallery.css" rel="stylesheet" type="text/css" media="screen" />
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
  <?php query_posts('category_name='.$gallery.'&posts_per_page=3'); ?>
  <?php while (have_posts()) : the_post(); ?>
  
<li><?php the_content(); ?></li>

<?php endwhile;?>             
            
			</ul>
		</div>
      
      
      
      
    </div>
    
    </div>
    
    
        <?php include "bottom.php"; ?>
    
  </div>
<? get_footer(); ?>
