<?php
/*
Template Name: Events Page
*/
?>

<? get_header(); ?>

<div id="content-teams">
  <div id="top">
  <div id="content-title"><?php the_post_thumbnail('inside'); ?></div>
  <div id="events">
  
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/events.png" width="702" height="417" />
  
  </div>
  
  
  
  <div id="steps">
  <font color="#0d5cab" size="+1">
<?php echo get_option('of_steps') ?>
  </font>
  </div>
  
  <a href="#">
  <div id="get-started">
  
  Click here to get started
  
  </div>
  </a></div>
  </div>
<? get_footer(); ?>
