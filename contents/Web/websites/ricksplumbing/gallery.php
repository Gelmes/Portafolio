
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
                <!--
				<li><a href="http://templatica.com/preview/30"><img src="images/01.jpg" alt="Css Template Preview" /></a></li>
				<li><a href="http://templatica.com/preview/7"><img src="images/02.jpg" alt="Css Template Preview" /></a></li>
				<li><a href="http://templatica.com/preview/25"><img src="images/03.jpg" alt="Css Template Preview" /></a></li>
				<li><a href="http://templatica.com/preview/26"><img src="images/04.jpg" alt="Css Template Preview" /></a></li>
				<li><a href="http://templatica.com/preview/27"><img src="images/05.jpg" alt="Css Template Preview" /></a></li>	
                -->		
			</ul>
		</div>
	

