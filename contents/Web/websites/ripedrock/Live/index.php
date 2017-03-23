
<title>Septic tank installation & Repair - Ripedrock</title>
<meta name="description" content="We are a septic contractor, we are able to offer the best solution for any septic system you may need, including, septic tank pumping fast and Septic tank installation, and a complete line of septic system  products.">

<?php include "header.php"; ?>
<div id="content">
  <div id="top">
  <div id="slide_wrapper">
		<script src="js/flux.js" type="text/javascript" charset="utf-8"></script>		
		<script type="text/javascript" charset="utf-8">
			$("#nav ul li:nth-child(1)").css('background-color','#ff9900');
			$(function(){
				if(!flux.browser.supportsTransitions)
					alert("Flux Slider requires a browser that supports CSS3 transitions");
					
				window.f = new flux.slider('#slider', {
					pagination: false,
					width:900,	
					height:360,
					controls: false,
					transitions: ['blocks', 'zip', 'blinds'],
					autoplay: true
				});
				
				$('.transitions').click(function(event){
					event.preventDefault();
					window.f.next($(event.target).data('transition'), $(event.target).data('params'));
				});
			});
		</script>        
        <div id="slider">
                    <img src="images/s2.jpg" alt="backhoe service" width="200px" title="Ironman Screenshot" />
                    <img src="images/s2.jpg" alt="backhoe san bernandino" width="200px" title="Ironman Screenshot" />
		</div>
        </div>
        
        
  <div id="gradient"><img src="images/gradient.png" alt="gradient" style="z-index:5;" width="300px;" height="360"/></div>
  
  </div>
  <div id="mid">
  
  <ul class="bottom_nav">
  <li>
  <h2>About Us</h2>
  <p>
  As septic contractor we are able to offer the best solution for any septic system you may need, including, tank pumping, fast professional installation, and a complete line of septic system  products. <a href="about.php">Read more...</a></p>
  </li>
  <li>
  <h2>Services</h2>
  New Septic Tank Installations<br/>
  Leach Line or leach fields Installations<br/>
  Septic Tank, Cesspool Pumping<br/>
  Septic Tank Repairs<br/>
  Septic Tank Replacement<br/>
  Grease TrapsTank Locating<br/>
  Trenching for dry utilities<br/>
  Ruff grading lots<br/>
  Stump removals<br/>
  </li>
  <li>
  <h2>Counties of Servie Areas</h2>
  LA, Los Angeles<br/>
  San Bernandino<br/>
  Orange<br/>
  Riverside<br/>
  </li>
  <li>
  <div style="width:100%"></div>
  <!--<img src="images/ablamos.png" alt="ablamos espanol" width="100%" style="border:solid #CCCCCC 1px; padding:10px; margin:20px; position:relative"/>-->
  </li>  
  </ul>
  
  </div>
  <div id="bottom">
  </div>
</div>
<?php include "footer.php"; ?>
