<? get_header(); ?>
  <div id="content">
    <div id="top">
      
     <div id="home" style="position:relative; left:49px;"><?php include "slider.php"; ?></div>
      
      
      
      <script type="text/javascript">
	var _lofmain =  $('lofslidecontent45');
	var _lofscmain = _lofmain.getElement('.lof-main-wapper');
	var _lofnavigator = _lofmain.getElement('.lof-navigator-outer .lof-navigator');
	var object = new LofFlashContent( _lofscmain, 
									  _lofnavigator,
									  _lofmain.getElement('.lof-navigator-outer'),
									  { fxObject:{ transition:Fx.Transitions.Quad.easeInOut,  duration:800},
									 	 interval:3000,
							 			 direction:'opacity',
										 navItemHeight:84} );
	object.start( true, _lofmain.getElement('.preload') );
    </script>
    </div>    
    
    <div id="mid">
    
    
    <? $greeting = get_option('of_greeting') ?>
  <?php query_posts('category_name='.$greeting.'&posts_per_page=1'); ?>
  <?php while (have_posts()) : the_post(); ?>
  
      <br/>
    <div style="float:right; padding-left:20px;">
    
    <?php the_post_thumbnail(); ?>
    
    </div>

<h1><?php the_title(); ?></h1>
<?php the_content(); ?>

<!-- Add your content here -->
<?php endwhile;?> 
    
    </div>
    
    
    <?php include "bottom.php"; ?>
    
    
    
    
  </div>
<? get_footer(); ?>
