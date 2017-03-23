<div id="lofslidecontent45" class="lof-slidecontent">
        <div class="preload">
          <div></div>
        </div>
        <!-- MAIN CONTENT -->
        <div class="lof-main-wapper">
        
       <? $slider = get_option('of_slider') ?>
  <?php query_posts('category_name='.$slider.'&posts_per_page=4'); ?>
  <?php while (have_posts()) : the_post(); ?>
<div class="lof-main-item"> 
<?php the_content(); ?>
</div>
<?php endwhile;?> 
          
          
        </div>
        <!-- END MAIN CONTENT -->
        <!-- NAVIGATOR -->
        <div class="lof-navigator-outer">
          <ul class="lof-navigator">
            <? $slider_thumbnails = get_option('of_slider_thumbnails') ?>
  <?php query_posts('category_name='.$slider_thumbnails.'&posts_per_page=4'); ?>
  <?php while (have_posts()) : the_post(); ?>
<li>
<div>

 <?php the_post_thumbnail(); ?>
<h5><?php the_title(); ?></h5>
<?php the_content(); ?>

</div>
</li>
<?php endwhile;?> 
            
          </ul>
        </div>
      </div>