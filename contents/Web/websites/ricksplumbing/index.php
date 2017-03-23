<?php include "header.php"; ?>
  <div id="content">
    <div id="top">
      
     <div id="home" style="position:relative; left:49px;"><?php include "slider.php"; ?></div>
      
      
      
      <script type="text/javascript">
	var _lofmain =  $('lofslidecontent45');
	var _lofscmain = _lofmain.getElement('.lof-main-wapper');
	var _lofnavigator = _lofmain.getElement('.lof-navigator-outer .lof-navigator');
	var object = new LofFlashContent( _lofscmain, 
									  _lofnavigator,
									  _lofmain.getElement('.lof-navigator-outer'),
									  { fxObject:{ transition:Fx.Transitions.Quad.easeInOut,  duration:800},
									 	 interval:3000,
							 			 direction:'opacity',
										 navItemHeight:84} );
	object.start( true, _lofmain.getElement('.preload') );
    </script>
    </div>    
    
    <div id="mid">
    
    <br/>
    <div style="float:right; padding-left:20px;">
    <img src="images/family.png" />
    </div>
    <h1>Plumbing Specialists</h1>
    <p class="style-1">
    Rick's Plumbing provides a full range of plumbing services including; drain cleaning, trenchless sewers, installing, repairing, replacing all pipes, and copper repiping services for the Fullerton and the surrounding Orange County area. Over 30 years of experience Rick's Plumbing has acquired the ability to quickly and accurately diagnose any plumbing work that needs to be done. That way, when you have a situation that requires a professional plumber, you'll feel confident in calling on Rick's Plumbing for help.
    </p>
    
    </div>
    
    <div id="bottom" style="background-image:url(images/bottom.png); height:320px; background-repeat:no-repeat; margin-top:0px;">        <div id="video"><div style="margin-left:0px; margin-bottom:0px">Brands Installed</div>
    

    <iframe id="frame" src="gallery.php">
  </iframe>
    
    
    </div>
    <div id="services">
    <h1>Our Services</h1> 
    
    <p class="style-2">New Construction</p>
    <p class="style-2">Copper Repiping</p>
    <p class="style-2">Water Heaters</p>
    <p class="style-2">Water Sotteners</p>
    <p class="style-2">Water Purification Systems</p>
    <p class="style-2">Toilets & Faucets</p>
    <p class="style-2">Water Lines</p>
    <p class="style-2">Gas Lines</p>
    <p class="style-2">Sewer Service</p>
    <p class="style-2">Inspections</p>
    
    </div>
    <div id="areas">
    <h1>Service Areas</h1> 
    <p class="style-2">Fullerton</p>
    <p class="style-2">Brea</p>
    <p class="style-2">Yorba Linda</p>
    <p class="style-2">Placentia</p>
    <p class="style-2">Anaheim</p>
    <p class="style-2">Newport Beach</p>
    <p class="style-2">Irvine</p>
    <p class="style-2">Tustin</p>
    <p class="style-2">Santa Ana</p>
    <p class="style-2">Garden Grove</p>
    <p class="style-2">Laguna Niguel</p>
    <p class="style-2">Orange County</p>
    <p class="style-2">LA County</p>
    
    </div>
    
    
    
    </div>
  </div>
  <?php include "footer.php"; ?>
