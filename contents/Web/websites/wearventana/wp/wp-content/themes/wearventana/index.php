<? get_header(); ?>
<div id="content">
  <div id="top">
  
  <div id="slider-wrapper">
  	<? $banners = get_option('of_banners') ?>
  <?php query_posts('category_name='.$banners.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
  <div id='coin-slider'>
	<?php the_content(); ?>
</div>
<?php endwhile;?>

</div>


  <? $teams = get_option('of_teams') ?>
  <?php query_posts('category_name='.$teams.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<div id="content-1" class="content-box">
  <h1><?php the_title(); ?></h1>
  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
   </div>
<?php endwhile;?>
  
  <? $events = get_option('of_events') ?>
  <?php query_posts('category_name='.$events.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<div id="content-2" class="content-box">
  <h1><?php the_title(); ?></h1>
  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
   </div>
<?php endwhile;?>

<? $retail = get_option('of_retail') ?>
  <?php query_posts('category_name='.$retail.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<div id="content-3" class="content-box">
  <h1><?php the_title(); ?></h1>
  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
   </div>
<?php endwhile;?>
  
  
    
    <? $welcome = get_option('of_welcome') ?>
  <?php query_posts('category_name='.$welcome.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<div id="content-text">
  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>
  
  </div>
<?php endwhile;?>
  
  </div>  
  <div id="mid">
  
  
  
  </div>
  <div id="bottom"></div>
</div>
<? get_footer(); ?>
