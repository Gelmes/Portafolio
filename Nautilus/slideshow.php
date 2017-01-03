<script>

$(document).ready(function() {
	$("#slideshow > div:gt(0)").hide();

	setInterval(function() { 
		$('#slideshow div:first').fadeOut(1000);
		$('#slideshow div:first').next().fadeIn(1000).end().appendTo('#slideshow');		
	}, 6000);
	
	$('#slide_button').click(function(){
		$('#slideshow div:first').fadeOut(1000);
		$('#slideshow div:first').next().fadeIn(1000).end().appendTo('#slideshow');		
	});		
	
});
</script>
<div>

<div id="slide_button" style="position:absolute; z-index:1; width:990px; height:500px;"></div>
<div id="slideshow">
       
	   <!--<div id="home_video"><iframe width="990" height="557" src="//www.youtube.com/embed/9JwGQLE8Tbo?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>-->
	   <div><img src="./images/slideshow/s1.jpg"  width="990px" /></div>
	   <div><img src="./images/slideshow/s2.jpg"  width="990px" /></div>
	   <div><img src="./images/slideshow/s3.jpg"  width="990px" /></div>
	   <div><img src="./images/slideshow/s4.jpg"  width="990px" /></div>
</div>

</div>
<div><img src="images/shadow.png"></div>