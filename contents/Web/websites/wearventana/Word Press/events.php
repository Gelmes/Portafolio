<? get_header(); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="<? bloginfo('stylesheet_directory'); ?>/js/animatedcollapse.js">

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
  <div id="content-title"><img src="<? bloginfo('stylesheet_directory'); ?>/images/title-3.png" /></div>
  <div id="events">
  
  <img src="<? bloginfo('stylesheet_directory'); ?>/images/events.png" width="702" height="417" />
  
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
<? get_footer(); ?>
