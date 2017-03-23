<script src="js/jquery.js" type="text/javascript"></script>

<script type="text/javascript">
	
// JavaScript Document
var speed = 1;

$(document).ready(function(){
			   
//*********************************************Mouse In****************************************************		

$('#grey1').mouseover(
function (){	
	document.getElementById('grey1').style.display = "none";
	document.getElementById('color1').style.display = "block";
});
$('#grey2').mouseover(
function (){
	document.getElementById('grey2').style.display = "none";
	document.getElementById('color2').style.display = "block";	
});

$('#grey3').mouseover(
function (){
	document.getElementById('grey3').style.display = "none";
	document.getElementById('color3').style.display = "block";	
});

$('#grey4').mouseover(
function (){
	document.getElementById('grey4').style.display = "none";
	document.getElementById('color4').style.display = "block";	
});

$('#grey5').mouseover(
function (){
	document.getElementById('grey5').style.display = "none";
	document.getElementById('color5').style.display = "block";	
});

$('#grey6').mouseover(
function (){
	document.getElementById('grey6').style.display = "none";
	document.getElementById('color6').style.display = "block";	
});

$('#grey7').mouseover(
function (){
	document.getElementById('grey7').style.display = "none";
	document.getElementById('color7').style.display = "block";	
});

$('#grey8').mouseover(
function (){
	document.getElementById('grey8').style.display = "none";
	document.getElementById('color8').style.display = "block";	
});

$('#grey9').mouseover(
function (){
	document.getElementById('grey9').style.display = "none";
	document.getElementById('color9').style.display = "block";	
});


//*********************************************Mouse Out****************************************************



$('#color1').mouseout(
function (){
	document.getElementById('grey1').style.display = "block";
	document.getElementById('color1').style.display = "none";	
});

$('#color2').mouseout(
function (){
	document.getElementById('grey2').style.display = "block";
	document.getElementById('color2').style.display = "none";});

$('#color3').mouseout(
function (){
	document.getElementById('grey3').style.display = "block";
	document.getElementById('color3').style.display = "none";});

$('#color4').mouseout(
function (){
	document.getElementById('grey4').style.display = "block";
	document.getElementById('color4').style.display = "none";});

$('#color5').mouseout(
function (){
	document.getElementById('grey5').style.display = "block";
	document.getElementById('color5').style.display = "none";});

$('#color6').mouseout(
function (){
	document.getElementById('grey6').style.display = "block";
	document.getElementById('color6').style.display = "none";});

$('#color7').mouseout(
function (){
	document.getElementById('grey7').style.display = "block";
	document.getElementById('color7').style.display = "none";});

$('#color8').mouseout(
function (){
	document.getElementById('grey8').style.display = "block";
	document.getElementById('color8').style.display = "none";});

$('#color9').mouseout(
function (){
	document.getElementById('grey9').style.display = "block";
	document.getElementById('color9').style.display = "none";});
					   
						   
						   
						   
});
	    
</script>

<style>


#brands{
	position:relative;
	width:1000px;
	height: 30px;
	list-style:none;
	left: -20px;
}
#brands ul {
 list-style:none;
 margin:0;
 padding:0;
}

#brands li {
	font-family: 'Open Sans', sans-serif;
	font-size:18px;
	float:left;
	margin:0;
	padding-bottom:2px;
	padding-top:2px;
	padding-right:5px;
	text-align:center;
	color:#ffffff;
}
#brands li a {
	font-family: 'Open Sans', sans-serif;
	font-size:18px;
	float:left;
	margin:0;
	padding-bottom:2px;
	padding-top:2px;
	padding-right:4px;
	text-align:center;
	color:#ffffff;
	text-decoration:none;
}


</style>


<ul id="brands">
<li>
<a href="http://www.deltafaucet.com/index.html"><img id="color1" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/delta.png" height="28" />
<img id="grey1" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/delta - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.grohe.com/"><img id="color2" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/Grohe.png" height="28" />
<img id="grey2" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/Grohe - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.franke.com/kitchensystems/us/en/home.html"><img id="color3" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/franke.png" height="28" />
<img id="grey3" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/franke - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.moen.com/"><img id="color4" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/moen.png" height="28" />
<img id="grey4" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/moen - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.noritz.com/"><img id="color5" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/noritz.png" height="28" />
<img id="grey5" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/noritz - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.pfisterfaucets.com/home.aspx"><img id="color6" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/Pfister.png" height="28" />
<img id="grey6" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/Pfister - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.takagi.com/"><img id="color7" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/Takagi.png" height="28" />
<img id="grey7" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/Takagi - Copy.png" height="28" /></a>

</li>
<li>
<a href="http://www.totousa.com/"><img id="color8" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/toto.png" height="28" />
<img id="grey8" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/toto - Copy.png" height="28" /></a>
</li>
<li>
<a href="http://www.watts.com/"><img id="color9" style="display:none;" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/watts.png" height="28" />
<img id="grey9" src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/watts - Copy.png" height="28" /></a>
</li>
</ul>