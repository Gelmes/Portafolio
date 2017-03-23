<?php
ob_start();
session_start();

include "elements/user_header.php"; 
include_once 'functions/functions.php';

//Handle user if he is loged out
logged_out();

ob_end_flush();
?>

<div id="content">
	<?php include "elements/sidebar.php"; ?>
    <div id="feed">
    <?php echo get_feed(); ?>
    </div>
 </div> 
  
</div><!-- Window -->

<?php include "elements/footer.php"; ?>
