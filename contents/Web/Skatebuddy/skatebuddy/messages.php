<?php
ob_start();
session_start();

include "elements/user_header.php"; 
include_once 'functions/functions.php';
include_once 'functions/config.php';

//Handle user if he is loged out
logged_out();

$user_id = get_user_id($_SESSION['sesh']);

echo get_user_firstname1($user_id)." ";
echo get_user_lastname1($user_id).'<br/>';

/*
$message = get_last_message_for(2);
echo $message['message'].'<br/>';
echo get_user_last_login(555555).'<br/>';
echo delete_session(555555).'<br/>';
$user_id = get_user_id(create_session(555555)).'<br/>';

echo get_user_firstname1($user_id);
echo get_user_lastname1($user_id).'<br/>';

$contacts = get_user_contacts1($user_id);
foreach ($contacts as $key => $value){
	echo get_user_firstname1($contacts[$key]);
	echo get_user_lastname1($contacts[$key]);
}
*/

ob_end_flush();
if (isset($_SESSION['list'])){
	foreach ($_SESSION['list'] as $key => $value){
		echo $value.'<br/>';
	}
}

unset($_SESSION['list']);
?>


<script>
function do_ajax(){
		$.ajax({  
			type: 'POST',  
			url: 'functions/pull_contacts.php', 
			data: { to: $("#to").attr("value") },		
			success: function(response) {
				alert(response);
				$("#send_to").html(response); //Adds the response to this div				
				$("#send_to div").click(function() { //If the new div is clicked its added
					
					$("#send_to").html(""); //Since an option in "to who" was clicke "to who" is removed					
					$("#to_text").remove();
					$("#to_who").html("<div id='to_text'>To:</div>" + "<span>" + $(this).html() + "   <img src='images/delete.png' width='10px' height='10px' onclick=\"$(this).parent().remove();\"/></span>"  + $("#to_who").html());					
					$("#to").focus();
				});	
			},
			error: function(){ alert("Error: Failed to fetch request")},	
		});				
};
function handle_contact(){
		//For every element found in the "to_who" tab, we will send
		//a message to. We must somehow assign the value of the hidden
		//inputs to the "to_who" div's
		$('#recipient').each(function(index,element){
			alert(element.value);			
		});
		
		$.ajax({  
			type: 'POST',  
			url: 'functions/handle_port.php', 
			data: { to: $("#to").attr("value") },		
			success: function(response) {
				alert(response);
				$("#send_to").html(response); //Adds the response to this div
			},
			error: function(){ alert("Error: Failed to fetch request")},	
		});				
};
</script>

<div id="content">
	<?php
    include "elements/sidebar.php";
	echo "<div id='conversations'>";
    //get_conversations 
	?>
	<h3>Marco Rubio</h3>
	<div>"Go tricking bro"</div>
	<?php
    echo "</div>";
    ?>    
    
    <div id="messages" class="shadow">
    <div id="loaded_messages" class="field_div"></div>
    <form id="messages_form" action="" method="post" autocomplete="off">
    <input type="hidden" value="" />
    <div id="to_who" onclick="$('#to').focus();"><div id="to_text">To:</div><input type="text" id="to" name="to" value="" onkeyup="do_ajax();" /></div>
    <div id="send_to"></div>
    <textarea id="message" name="message"></textarea>
    <input type="submit" name="submit" value="Submit" onmouseover="handle_contact()" class="button" />
    </form>
    
    <?php //echo get_messages($_SESSION['email']); ?>
    </div>
</div> 
  
</div><!-- Window -->

<?php include "elements/footer.php"; ?>
