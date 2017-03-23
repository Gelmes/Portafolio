<link href="css/style.css" rel="stylesheet" type="text/css" />
<div id="footer">

<div id="links" class="footer-list">

<h2>Important</h2>
<a href="teams.php">Teams & Clubs</a><br />
<a href="events.php">Events</a><br />
<a href="retail.php">Retail</a><br />
<a href="#">Jersey Design</a><br />

</div>

<div id="help" class="footer-list">

<h2>Need Help?</h2>
<a href = "javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';">Contact Us</a>

</div>

<div id="facebook">
<a href="http://www.facebook.com/"><img src="<? bloginfo('stylesheet_directory'); ?>/images/facebook.png" /></a>
</div>

<div id="twitter">
<a href="https://twitter.com/"><img src="<? bloginfo('stylesheet_directory'); ?>/images/twitter.png" /></a>
</div>

<!--
<div id="news" style="float:right; padding-right:10;">
<h2>Newsletter</h2><br />
<input type="text" size="25"/><br /><br />
<input type="button" value="Sign Me Up!" style="float:right;"/>
</div>
-->


<div id="copyright">Copyright 2012. All rights reserved | Site created by <a href="http://www.pdrmediaonline.com/">PDR Media</a></div>

</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({ width: 1600, height: 616, delay: 5000, links : false, hoverPause: true });
	});
</script>

<?php wp_footer(); ?>
</body>


<div id="light" class="white_content">
<center>
<form id="emf-form" enctype="multipart/form-data" method="post" action="http://www.emailmeform.com/builder/form/e7P0z08ab637lJUhdWt19BjN" name="emf-form">
  <table style="text-align:left;" cellpadding="2" cellspacing="0" border="0" bgcolor="transparent">
    <tr>
         <td style="" colspan="2">
        <img src="<? bloginfo('stylesheet_directory'); ?>/images/logo.png" />
      </td>
      </tr>
      <tr>
      <td style="" colspan="2">
        <font face="Verdana" size="2" color="#0d5cab"><b style="font-size:20px;">Contact Us Form</b><br />
        <br /></font>
      </td>
    </tr>
    <tr valign="top">
      <td id="td_element_label_0" style="" align="">
        <font face="Verdana" size="2" color="#0d5cab"><b>Name</b></font> <span style="color:red;"><small>*</small></span>
      </td>
            <td id="td_element_label_3" style="" align="">
        <font face="Verdana" size="2" color="#0d5cab"><b>Message</b></font> <span style="color:red;"><small>*</small></span>
      </td>
    </tr>
    <tr>
      <td id="td_element_field_0" style="">
        <input id="element_0" name="element_0" value="" size="30" class="validate[required]" type="text" />
        <div style="padding-bottom:8px;color:#000000;"></div>
      </td>
            <td id="td_element_field_3" style="" rowspan="5">
        <textarea id="element_3" name="element_3" cols="30" rows="10" class="validate[required]">
</textarea>
        <div style="padding-bottom:8px;color:#000000;"></div>
      </td>
    </tr>
    <tr valign="top">
      <td id="td_element_label_1" style="" align="">
        <font face="Verdana" size="2" color="#0d5cab"><b>Email</b></font> <span style="color:red;"><small>*</small></span>
      </td>
    </tr>
    <tr>
      <td id="td_element_field_1" style="">
        <input id="element_1" name="element_1" class="validate[required,custom[email]]" value="" size="30" type="text" />
        <div style="padding-bottom:8px;color:#000000;"></div>
      </td>
    </tr>
    <tr valign="top">
      <td id="td_element_label_2" style="" align="">
        <font face="Verdana" size="2" color="#0d5cab"><b>Subject</b></font> <span style="color:red;"><small>*</small></span>
      </td>
    </tr>
    <tr>
      <td id="td_element_field_2" style="">
        <input id="element_2" name="element_2" value="" size="30" class="validate[required]" type="text" />
        <div style="padding-bottom:8px;color:#000000;"></div>
      </td>
    </tr>
    
    
    <tr>
      <td colspan="2" align="right">
        <input name="element_counts" value="4" type="hidden" /> <input name="embed" value="forms" type="hidden" /><input class="lumos-button" value="Send email" type="submit" style="margin-right:10px;" /><input class="lumos-button" value="Clear" type="reset" />
      </td>
    </tr>
  </table>
</form>
</center>

<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img src="images/Close_Icon.png" width="30px" height="30px" style="
  position:absolute;
  top:5px;
  right:5px;"/></a>

</div>
		<div id="fade" class="black_overlay"></div>


</html>