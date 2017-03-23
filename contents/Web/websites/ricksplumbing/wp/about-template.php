<?php
/*
Template Name: About Us
*/
?>

<? get_header(); ?>
  <div id="content">
  
  
    <div id="about">
    <div style="float:right;"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/plumber.gif" height="500px" /></div>
    <div id="top">
    
    
        <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <div style="clear:both"></div>
<?php endwhile; ?>
<?php else : ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php get_search_form(); ?>
<?php endif; ?>

      
      

      
      
    </div>
    </div>    
      
        <?php include "bottom.php"; ?>
    
  </div>
<? get_footer(); ?>