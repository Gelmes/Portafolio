<?php
/*
Template Name: Teams Page
*/
?>

<? get_header(); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/animatedcollapse.js">

/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


<script type="text/javascript">

animatedcollapse.addDiv('package-1', 'fade=0,speed=400, hide=1')
animatedcollapse.addDiv('package-2', 'fade=0,speed=400, hide=1')
animatedcollapse.addDiv('package-3', 'fade=0,speed=400, hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>

<div id="content-teams">
  <div id="top">
  <div id="content-title"><?php the_post_thumbnail('inside'); ?></div>
  <div id="colapse">

<div id="package-wrapper-1">

<center>
<? $package1 = get_option('of_package1') ?>
  <?php query_posts('category_name='.$package1.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<h3><?php the_title(); ?></h3>
</center>
<div id="package-1">
<center>
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/shrink-2.png" border="0" />
</center>
<?php the_content(); ?>

<?php endwhile;?>
</div>
<center>
<a href="#" rel="toggle[package-1]" data-openimage="<? bloginfo('stylesheet_directory'); ?>/images/shrink.png" data-closedimage="<? bloginfo('stylesheet_directory'); ?>/images/shrink-2.png"><img src="<? bloginfo('stylesheet_directory'); ?>/images/shrink.png" border="0" /></a></center>
</div>

<div id="package-wrapper-2">
<center>
<? $package2 = get_option('of_package2') ?>
  <?php query_posts('category_name='.$package2.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<h3><?php the_title(); ?></h3>
</center>
<div id="package-2">
<center>
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/shrink-2.png" border="0" />
</center>
<p class="style-1"><?php the_content(); ?></p>

<?php endwhile;?>
</div>
<center>
<a href="#" rel="toggle[package-2]" data-openimage="<? bloginfo('stylesheet_directory'); ?>/images/shrink.png" data-closedimage="<? bloginfo('stylesheet_directory'); ?>/images/shrink-2.png"><img src="<? bloginfo('stylesheet_directory'); ?>/images/shrink.png" border="0" /></a></center>
</div>

<div id="package-wrapper-3">
<center>
<? $package3 = get_option('of_package3') ?>
  <?php query_posts('category_name='.$package3.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<h3><?php the_title(); ?></h3>
</center>
<div id="package-3">
<center>
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/shrink-2.png" border="0" />
</center>
<p class="style-1"><?php the_content(); ?></p>

<?php endwhile;?>
</div>
<center>
<a href="#" rel="toggle[package-3]" data-openimage="<? bloginfo('stylesheet_directory'); ?>/images/shrink.png" data-closedimage="<? bloginfo('stylesheet_directory'); ?>/images/shrink-2.png"><img src="<? bloginfo('stylesheet_directory'); ?>/images/shrink.png" border="0" /></a></center>
</div>

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
