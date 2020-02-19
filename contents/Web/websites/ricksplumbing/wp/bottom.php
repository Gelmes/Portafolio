

<div id="bottom" style="background-image:url(<?php bloginfo('stylesheet_directory'); ?>/images/bottom.png); height:320px; background-repeat:no-repeat; margin-top:0px;"> 


       
    <div id="video"><div style="margin-left:0px; margin-bottom:20px; ">Brands Installed</div>
    

    <iframe id="frame" src="<?php bloginfo('stylesheet_directory'); ?>/gallery.php">
  </iframe>
    
    
    </div>
    <div id="services">
    
    <? $bottom = get_option('of_bottom') ?>
  <?php query_posts('category_name='.$bottom.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<!-- Add your content here -->
<?php the_content(); ?>
<?php endwhile;?> 
    
    
    </div>
    
    
    <div id="areas">
    
    
    
        <? $areas = get_option('of_areas') ?>
  <?php query_posts('category_name='.$areas.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
<!-- Add your content here -->
<?php the_content(); ?>
<?php endwhile;?> 


    
    </div>
    
    
    
    </div>