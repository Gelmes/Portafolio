<?php
/**
* @package WordPress
* @subpackage My_Theme
*/
 
get_header(); ?>
 
<div id="content" class="narrowcolumn" role="main">
 
<?php if (have_posts()) : ?>
 
<?php while (have_posts()) : the_post(); ?>
 
<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
 
<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to
<?php the_title_attribute(); ?>"><?php the_title(); ?></a><br /></h1>
 
<span>Posted on: <?php the_time('F jS, Y') ?> <?php comments_popup_link('0
comment', '1 comment', '% comments'); ?></span>
 
<?php the_content('Read the rest of this entry &raquo;'); ?>
 
<div class="metatags"><?php the_tags( 'Tagged under: ', ', ', '<br />');
?>Categorised under: <?php the_category(', ') ?></div>
 
</div>
 
<?php endwhile; ?>
 
<div class="pagination">
 
<?php next_posts_link('&laquo; Older Entries') ?> | <?php
previous_posts_link('Newer Entries &raquo;') ?>
 
</div>
 
<?php else : ?>
 
<h1 class="center">Not Found</h1>
 
<p class="center">Sorry, but you are looking for something that isn't here.</p>
 
<?php get_search_form(); ?>
 
<?php endif; ?>
 
</div>
 
<br />
 
<br />
 
<?php get_footer(); ?>