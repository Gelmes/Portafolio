// JavaScript Document

function set_focus(object){
	    setTimeout(function(){
        object.focus();
        },100);
	
}
function eraseSignupText (field){
	if (field == 1 && ($("#first_name").attr("value") == 'First Name')){		
		$("#first_name").attr("value", "");
	};
	if (field == 2 && ($("#last_name").attr("value") == 'Last Name')){		
		$("#last_name").attr("value", "");
	};
	if (field == 3 && ($("#email").attr("value") == 'Email')){		
		$("#email").attr("value", "");
	};
	if (field == 4 && ($("#password_text").attr("value") == 'Create Password')){
		$("#password").focus();		
		$("#password_text").css("display", "none");		
		$("#password_check_text").css("position", "absolute");
		$("#password_check_text").css("left", "171px");
	};
	
	if (field == 5 && ($("#password_check_text").attr("value") == 'Reenter Password')){	
		$("#password_check").focus();		
		$("#password_check_text").css("display", "none");
	};
};
function eraseSignupText_t (field){
	if (field == 1 && ($("#first_name").attr("value") == 'First Name')){		
		$("#first_name").attr("value", "");
	};
	if (field == 2 && ($("#last_name").attr("value") == 'Last Name')){		
		$("#last_name").attr("value", "");
	};
	if (field == 3 && ($("#email").attr("value") == 'Email')){		
		$("#email").attr("value", "");
	};
	if (field == 4 && ($("#password_text").attr("value") == 'Create Password')){
		$("#password_text").css("display", "none");		
		$("#password_check_text").css("position", "absolute");
		$("#password_check_text").css("left", "171px");
	};
	
	if (field == 5 && ($("#password_check_text").attr("value") == 'Reenter Password')){	
		$("#password_check_text").css("display", "none");
	};
};

function do_ajax(){
		$.ajax({  
			type: 'POST',  
			url: 'functions/pull_contacts.php', 
			data: { to: $("#to").attr("value") },		
			success: function(response) {
				$("#send_to").html(response); //Adds the response to this div
				
				$("#send_to div").click(function() { //If the new div is clicked its added
					$("#send_to").html(""); //Since an option in "to who" was clicke "to who" is removed					
					$("#to_text").remove();
					$("#to_who").html("<div id='to_text'>To:</div>" + "<span>" + $(this).html() + "   <img src='images/delete.png' width='10px' height='10px' onclick=\"$(this).parent().remove()\"/></span>"  + $("#to_who").html());					
					$("#to").focus();
				});	
			},
			error: function(){ alert("Error: Failed to fetch request")},	
		});				
};

function fix_size(){
		var header_height = parseInt($("#header").css("height"));	
		var content_height = parseInt($("#content").css("height"));		
		var content_width = parseInt($("#content").css("width"));
		var wrapper_height = parseInt($("#wrapper").css("height"));
		var wrapper_width = parseInt($("#wrapper").css("width"));	
		
		if (wrapper_height < min_height){
			wrapper_height = min_height;			
			$("#wrapper").css("height", wrapper_height);	
		}
		
		$("#sidebar").css("height", (wrapper_height - header_height));	         //All user pages
		$("#signup").css("height", (wrapper_height - header_height));         //Index.php
		$("#login").css("height", (wrapper_height - header_height));           //login.php
		$("#recover").css("height", (wrapper_height - header_height));         //recover.php
		$("#messages").css("height", (wrapper_height - header_height-40));       //messages.php
		$("#conversations").css("height", (wrapper_height - header_height));   //messages.php
		
		$("#map_canvas").css("height", (wrapper_height - header_height));
		$("#map_canvas").css("width", (wrapper_width - sidebar_width - 2));	
		$("#content").css("height", (wrapper_height - header_height));
		$("#cover_img img").css("width", (wrapper_width - signup_width));
		
		//This peace of code is used by google maps
		initialize();
};
