<?php include "header.php"; ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js">

/***********************************************
* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


<script type="text/javascript">

animatedcollapse.addDiv('package-1', 'fade=0,speed=400, hide=1')
animatedcollapse.addDiv('package-2', 'fade=0,speed=400, hide=1')
animatedcollapse.addDiv('package-3', 'fade=0,speed=400, hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>


<div id="content-teams">
  <div id="top">
  <div id="content-title"><img src="images/title.png" /></div>
  <div id="colapse">

<div id="package-wrapper-1">

<center>
<h3>Package 1</h3>
</center>
<div id="package-1">
<center>
  <img src="images/shrink-2.png" border="0" />
</center>
<p class="style-1">The cat (Felis catus), also known as the domestic cat or house cat to distinguish it from other felines, is a small carnivorous species of crepuscular mammal that is often valued by humans for its companionship and its ability to hunt vermin. It has been associated with humans for at least 9,500 years. A skilled predator, the cat is known to hunt over 1,000 species for food. It can be trained to obey simple commands.</p>
</div>
<center>
<a href="#" rel="toggle[package-1]" data-openimage="images/shrink.png" data-closedimage="images/shrink-2.png"><img src="images/shrink.png" border="0" /></a></center>
</div>

<div id="package-wrapper-2">
<center>
<h3>Package 2</h3>
</center>
<div id="package-2">
<center>
<img src="images/shrink-2.png" border="0" /></center>
<p class="style-1">
The dog (Canis lupus familiaris) is a domesticated subspecies of the wolf, a mammal of the Canidae family of the order Carnivora. The term encompasses both feral and pet varieties and is also sometimes used to describe wild canids of other subspecies or species. The domestic dog has been one of the most widely kept working and companion animals in human history, as well as being a food source in some cultures.</p>
</div>
<center>
<a href="#" rel="toggle[package-2]" data-openimage="images/shrink.png" data-closedimage="images/shrink-2.png"><img src="images/shrink.png" border="0" /></a></center>
</div>

<div id="package-wrapper-3">
<center>
<h3>Package 3</h3>
</center>
<div id="package-3">
<center>
<img src="images/shrink-2.png" border="0" /></center>
<p class="style-1">
Rabbits are ground dwellers that live in environments ranging from desert to tropical forest and wetland. Their natural geographic range encompasses the middle latitudes of the Western Hemisphere. In the Eastern Hemisphere rabbits are found in Europe, portions of Central and Southern Africa, the Indian subcontinent, Sumatra, and Japan.</p>
</div>
<center>
<a href="#" rel="toggle[package-3]" data-openimage="images/shrink.png" data-closedimage="images/shrink-2.png"><img src="images/shrink.png" border="0" /></a></center>
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
