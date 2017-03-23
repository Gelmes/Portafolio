
      <?php
  $auto = "true";  
  $images = array(
				 "images/slides/1.png",
				 "images/slides/2.png",
				 "images/slides/3.png",
				 "images/slides/4.png",
				 "images/slides/5.png",
				 "images/slides/6.png",
				 "images/slides/7.png",
				 "images/slides/8.png",
				 "images/slides/9.png",
				 "images/slides/10.png"
				 );
  
  ?>



    <link href="./css/screen.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/easySlider1.7.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: <?php echo $auto ?>, 
				continuous: true,
				controlsShow:	false,
				pause:			3000,
			});
		});	
	</script>

		
		<div id="slider">
			<ul>
            <?php
				for ($i=0; $i<count($images); $i++)
				{
					echo "<li><img src=\"" . $images[$i] . "\"/></li>";
				}		
  				?>
			</ul>
		</div>
	

