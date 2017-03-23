<?php include "header.php"; ?>

<link rel="stylesheet" href="css/style-slider.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.aw-showcase.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			923,
		content_height:			525,
		fit_to_parent:			false,
		auto:					false,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				true,
		btn_numbers:			true,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			true,
		stoponclick:			true,
		transition:				'fade', /* hslide/vslide/fade */
		transition_delay:		500,
		transition_speed:		700,
		show_caption:			'onhover', /* onload/onhover/show */
		thumbnails:				false,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'vertical', /* vertical/horizontal */
		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			true, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
});

</script>

<div id="content-teams">
  <div id="top">
  <div id="content-title"><img src="images/title-2.png" /></div>
  <div id="retail">
  
  <div id="showcase" class="showcase">
  
		<div class="showcase-slide">
			<div class="showcase-content">
				<img src="images/bikeride.png"  />
			</div>
            <div class="showcase-tooltips">
            <a href="http://www.awkward.se" coords="537,86">
                	Some Text Here
            </a>
            <a href="http://www.awkward.se" coords="436, 112">
                    Some Text Here
            </a>
            <a href="http://www.awkward.se" coords="485, 195">
                    <img src="http://image.spreadshirt.com/image-server/image/product/18388796/view/1/type/png/width/378/height/378/biker-mountainbike-bike-mtb-downhill-sport-biking-t-shirts.png" width="150px" />
            </a>
        </div>
        
        
		</div>

</div>
  
  </div>
  
  
  
  <div id="steps">
  <font color="#0d5cab" size="+1">
1) Choose your package from the selections above<br/>

2) Design your custom Jersey<br/>

3) Confirm your order. Done!<br/>
  
  </font>
  </div>
  
  <a href="#">
  <div id="get-started">
  
  Click here to get started
  
  </div>
  </a></div>
  
  
  
  </div>
<?php include "footer.php"; ?>
