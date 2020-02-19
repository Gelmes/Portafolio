<?php
/**
* @package WordPress
* @subpackage My_Theme
*/
 
get_header(); ?>
 
<div id="content" class="widecolumn" role="main">
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
 
<h1><?php the_title(); ?></h1>
 
<div class="entry">
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
 
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
 
</div>
</div>
<?php comments_template(); ?>
<?php endwhile; endif; ?><br /><br />
 
<br /><br />
 
</div>
 
<?php get_footer(); ?>