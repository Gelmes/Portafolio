<?php include "header.php"; ?> 



<div id="content-other">

  <div id="top">
  <div id="content-contacts-4">
  <font face="TrajanPro-Regular" size="2" color="#666"><b style="font-size:20px;">Contact Us Here</b><br />
        <br /></font>
  <p class="style2">Email:</p><br/>
  <p class="style2">Phone:</p><br/>
  <p class="style2">Address:</p><br/>
  
  </div>
<div id="form-wrapper">
<form id="emf-form" enctype="multipart/form-data" method="post" action="http://www.emailmeform.com/builder/form/BWqGVfoTAsKrhZR92j8UaXew" name="emf-form">
  <div id="content-contacts-1">
        
        <font face="TrajanPro-Regular" size="2" color="#666"><b>Subject</b></font> <span style="color:red;"><small>*</small></span><br />
        <input id="element_0" name="element_0" value="" size="50" class="validate[required]" type="text" />
        <div style="padding-bottom:8px;color:#ffffff;"></div>
        
        <font face="TrajanPro-Regular" size="2" color="#666"><b>Name</b></font> <span style="color:red;"><small>*</small></span><br />
        <input id="element_1" name="element_1" value="" size="50" class="validate[required]" type="text" />
        <div style="padding-bottom:8px;color:#ffffff;"></div>
        
        <font face="TrajanPro-Regular" size="2" color="#666"><b>Email</b></font> <span style="color:red;"><small>*</small></span><br />
        <input id="element_3" name="element_3" class="validate[required,custom[email]]" value="" size="50" type="text" />
        <div style="padding-bottom:8px;color:#ffffff;"></div>
        
        </div>
        
        <div id="content-contacts-2">
        <font face="TrajanPro-Regular" size="2" color="#666"><b>Message</b></font> <span style="color:red;"><small>*</small></span><br />
        <textarea id="element_2" name="element_2" cols="42" rows="28" class="validate[required]"></textarea>
        <div style="padding-bottom:8px;color:#ffffff;"></div>
        </div>
        
        <div id="content-contacts-3">
        <script type="text/javascript">
		//<![CDATA[
        var RecaptchaOptions = {
                theme: 'clean',
                custom_theme_widget: 'emf-recaptcha_widget'
                };
        //]]>
        </script> <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LchicQSAAAAAGksQmNaDZMw3aQITPqZEsX77lT9">
        </script> <noscript><iframe src="https://www.google.com/recaptcha/api/noscript?k=6LchicQSAAAAAGksQmNaDZMw3aQITPqZEsX77lT9" height="121" width="454" frameborder="0"></iframe><br />
		<textarea name="recaptcha_challenge_field" rows="3" cols="40">
		</textarea>
		<input type="hidden" name="recaptcha_response_field" value="manual_challenge" /></noscript>
        <input name="element_counts" value="4" type="hidden" /> 
        <input name="embed" value="forms" type="hidden" /><input value="Send email" type="submit" /><input value="Clear" type="reset" />
      	</div>
        
        
</form>	
    </div>
  
  </div>
  <div id="bottom"></div>
</div>
<?php include "footer.php"; ?>
