// JavaScript Document

$(document).ready(function(){

var speed = 300;
var min_height = 700;

var header_height = parseInt($("#header").css("height"));	
var content_height = parseInt($("#content").css("height"));		
var content_width = parseInt($("#content").css("width"));
var wrapper_height = parseInt($("#wrapper").css("height"));
var wrapper_width = parseInt($("#wrapper").css("width"));	

if (wrapper_height < min_height){
	wrapper_height = min_height;			
	$("#wrapper").css("height", wrapper_height);	
}	

$("#message").resizable({maxWidth: 399,
						minWidth: 399,});

var sidebar_width = 200;									
var signup_width = 340;
var login_width = 340;
var recover_width = 340;
	
////////////////////////////////////////////////////////////////////////	
//Window sizing	
////////////////////////////////////////////////////////////////////////

	$("#sidebar").css("height", (wrapper_height - header_height));	         //All user pages
	$("#signup").css("height", (wrapper_height - header_height));         //Index.php
	$("#login").css("height", (wrapper_height - header_height));           //login.php
	$("#recover").css("height", (wrapper_height - header_height));         //recover.php
	$("#messages").css("height", (wrapper_height - header_height-40));       //messages.php
	$("#conversations").css("height", (wrapper_height - header_height));   //messages.php
	
	$("#map_canvas").css("height", (wrapper_height - header_height));
	$("#map_canvas").css("width", (wrapper_width - sidebar_width - 50));	
	$("#content").css("height", (wrapper_height - header_height));
	$("#cover_img img").css("width", (wrapper_width - signup_width));
	

////////////////////////////////////////////////////////////////////////	
//Animation & Effects		
////////////////////////////////////////////////////////////////////////
	$("#header").css('display', 'none');
	$("#content").css('display', 'none');
	$("#footer").css('display', 'none');
	$("#search_box").css('display', 'none');	
		
	$("#header").fadeIn(speed, function() {									 
	$("#search_box").fadeIn(speed, function() {
	$("#content").fadeIn(speed, function() {
	$("#footer").fadeIn(speed, function() {
										
		//Animations Happen Here								
		$("#sidebar").animate({width:sidebar_width}, sidebar_width);	
		$("#signup").animate({width:signup_width}, sidebar_width);	
		$("#login").animate({width:login_width}, sidebar_width);
		$("#recover").animate({width:recover_width}, sidebar_width);
		
		//This peace of code is used by google maps
		initialize();
	});
	
	});
	
	});
	
	});

////////////////////////////////////////////////////////////////////////	
//On Windows Resize	
////////////////////////////////////////////////////////////////////////
window.onresize = function() {	
	
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

}

////////////////////////////////////////////////////////////////////////	
//On Windows Reload	
////////////////////////////////////////////////////////////////////////
window.onload = function() {	
	
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

}

});

