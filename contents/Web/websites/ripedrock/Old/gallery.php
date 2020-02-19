<?php include "header.php"; ?>
<div id="content_other">
  
  <div id="wrap">
  
  <div id="gallery">



		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>		
		<script src="js/flux.js" type="text/javascript" charset="utf-8"></script>		
		<script type="text/javascript" charset="utf-8">
			$(function(){
				if(!flux.browser.supportsTransitions)
					alert("Flux Slider requires a browser that supports CSS3 transitions");
					
				window.f = new flux.slider('#slider', {
					pagination: true,
					controls: true,
					transitions: ['explode', 'tiles3d', 'bars3d', 'cube', 'turn'],
					autoplay: false
				});
				
				$('.transitions').click(function(event){
					event.preventDefault();
					window.f.next($(event.target).data('transition'), $(event.target).data('params'));
				});
			});
		</script>        
        <div id="slider">
                    <img src="images/s1.jpg" alt="" width="200px" />
                    <img src="images/s2.jpg" alt="" width="200px" title="Ironman Screenshot" />
		</div>
		
        
  </div>  
  </div>
  
</div>
<?php include "footer.php"; ?>
