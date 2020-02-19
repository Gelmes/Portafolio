<? get_header(); ?>
<div id="content">
  <div id="top">
  
  <div id="slider-wrapper">
  
  <div id='coin-slider'>
	<a href="<? bloginfo('stylesheet_directory'); ?>/images/slider.png" target="_blank">
		<img src="<? bloginfo('stylesheet_directory'); ?>/images/slider-1.png" width="853px" >
        <!--
		<span>
			Executive Building
		</span>
        -->
	</a>
	<a href="<? bloginfo('stylesheet_directory'); ?>/images/slider.png" target="_blank">
		<img src="<? bloginfo('stylesheet_directory'); ?>/images/slider-2.png" width="853px" >
        <!--
		<span>
			Inside The Building
		</span>
        -->
	</a>
</div>

  </div>


  <a href="teams.php">
  <div id="content-1" class="content-box">
  <h1>Teams & Clubs</h1>
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/content-image-1.png" />
  </div></a>
  
  <a href="events.php">
  <div id="content-2" class="content-box">
  <h1>Events</h1>
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/content-image-2.png" />
  </div></a>
  
  <a href="retail.php">
  <div id="content-3" class="content-box">
  <h1>Retail</h1>
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/content-image-3.png" />
  </div></a>
  
  <div id="content-text">
  <h1>Welcome</h1>
  <p class="style-1">
  Welcome
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean feugiat risus a eros sodales condimentum placerat urna faucibus. Sed arcu lectus, laoreet non lacinia sed, malesuada sed libero. Aliquam non pharetra ante. Integer ipsum nibh, varius nec imperdiet eget, mollis ac urna. Morbi cursus fringilla risus, sit amet suscipit augue porta vitae. Nulla nec faucibus ipsum. Mauris consectetur bibendum risus id tristique. Vivamus lectus tellus, lobortis nec euismod nec, volutpat eu nisi. Nulla consectetur lacinia urna, id elementum nisl rutrum vitae. 
  </p>
  
  </div>
  
  </div> 
  </div>
  
  <?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
 
<? get_footer(); ?>
