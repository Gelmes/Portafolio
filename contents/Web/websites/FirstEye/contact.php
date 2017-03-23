<?php include "header.php"; ?>
  <div id="content">
    <div id="top">
      
	<div id="box_about_border" class="clear_background">
    <div id="box_about" class="white_background">
    <h2>Contact Us</h2>
    <div style="float:right; margin:10px;"><img src="images/camera.jpg" /></div>    
    <div style="float:right;">
    <br/>
    <br/>
    <h3>Web Design:<br/>951-665-0311<br/>8:00am-5:00pm</h3><br/>
    <h3>Photography<br/>951-570-9409</h3>
    </div>
    
    <form action="form_handler.php"  method="post">
    <table>
    
    <br/>
    <tr>
    <td>Name:</td><td><input class="form_input" name="name" autocomplete="OFF"><br/></td>
    </tr>
    <tr>
    <td>Email:</td><td><input class="form_input" name="email" autocomplete="OFF"><br/></td>
    </tr>
    <tr>
    <td>Phone:</td><td><input class="form_input" name="phone" autocomplete="OFF"><br/></td>
    </tr>
    <tr>
    <td>Message:</td><td><textarea class="form_input" name="message"></textarea></td>
    </tr>
    <tr>
    <td><input type="submit" value="Submit" /></td>
    <td><input type="reset" value="Clear" /></td>
    </tr>
    </table>
    </form>    
    </div>    
    </div>

    </div>
    <div id="mid"></div>
    <div id="bottom"></div>
  </div>
  <?php include "footer.php"; ?>
