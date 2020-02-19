<?php
/*
Template Name: Contact Us
*/
?>

<? get_header(); ?>
  <div id="content">
  
  
    <div id="contact">

    <div id="top">
     
    <div id="form">
    
    <form name="subscribeform" onsubmit="return validateOnSubmit()" method="post" action="form_handler.php">
    
    <div id="message">
    <h2>Message:</h2><textarea name="message" rows="1" cols="20"></textarea>
    
    <span><input style="padding:10px;padding-bottom:5px;padding-top:5px; width:60px; margin-top:10px;" type="submit" value="Submit"></span>
	<span><input style="padding:10px;padding-bottom:5px;padding-top:5px; width:60px; margin-left:10px; margin-top:10px;" class="button" type="reset" value="Reset"></span>
    </div>
    
    <div id="info">
    <div><h2>Name:</h2><input maxlength="40" size="25" name="name" type="text"><br /><br /></div>
    <div><h2>Email:</h2><input maxlength="40" size="25" name="email" type="text"><br /><br /></div>
    <div><h2>Phone:</h2><input maxlength="40" size="25" name="phone" type="text"><br /><br /></div>
    </div>
    
    
    
    
    </form>
    
    </div>
    
     <div id="contact_text">
     
        <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <div style="clear:both"></div>
<?php endwhile; ?>
<?php else : ?>
<h2 class="center">Not Found</h2>
<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php get_search_form(); ?>
<?php endif; ?>

     
     
     </div>
     <div id="contact_info">
     <p class="style-4">
     Telephone: <?php echo get_option('of_phone') ?>
     </p>
     <p class="style-4">
     Email: <?php echo get_option('of_email') ?>
     </p>
     

     </div>
     
    </div>
    
    </div>
    


        <?php include "bottom.php"; ?>
    
  </div>
<? get_footer(); ?>
