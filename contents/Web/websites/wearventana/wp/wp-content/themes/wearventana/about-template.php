<?php
/*
Template Name: About Page
*/
?>
<? get_header(); ?>

<div id="content-teams">
  <div id="top">
  <div id="content-title"><?php the_post_thumbnail('inside'); ?></div>
  
  <? $about = get_option('of_about') ?>
  <?php query_posts('category_name='.$about.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
  <div id="about">
  <h4><?php the_title(); ?></h4>
  <?php the_content(); ?>
  </div>
<?php endwhile;?>
  </div>
  </div>
<? get_footer(); ?>
