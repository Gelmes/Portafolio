<?php
/**
* @package WordPress
* @subpackage My_Theme
*/
 
get_header(); ?>
 
<div id="content" class="widecolumn" role="main">
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
 
<h1><?php the_title(); ?></h1>
 
<span>Posted on: <?php the_time('F jS, Y') ?></span>
 
<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>');
?>
 
<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' =>
'</p>', 'next_or_number' => 'number')); ?>
 
<div class="metatags"><?php the_tags( 'Tagged under: ', ', ', '<br />');
?>Categorised under: <?php the_category(', ') ?></div>
 
</div>
 
<?php comments_template(); ?>
 
<?php endwhile; else: ?>
 
<p>Sorry, no posts matched your criteria.</p>
 
<?php endif; ?>
 
</div>
 
<?php get_footer(); ?>