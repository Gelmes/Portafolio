
var x = 'info_1';
var time = true;
		
var menuitem = menuitem;

$(document).ready(function(){
						   
						   
//====================== Div Shrink ========================//

$('#sb-1').click(function(){
	
	if 		($('#service-1').css('height') == '0px'){			  
	$('#service-1').animate({height: '550', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-1').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-2').click(function(){
	
	if 		($('#service-2').css('height') == '0px'){			  
	$('#service-2').animate({height: '280', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-2').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-3').click(function(){
	
	if 		($('#service-3').css('height') == '0px'){			  
	$('#service-3').animate({height: '300', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-3').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-4').click(function(){
	
	if 		($('#service-4').css('height') == '0px'){			  
	$('#service-4').animate({height: '300', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-4').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-5').click(function(){
	
	if 		($('#service-5').css('height') == '0px'){			  
	$('#service-5').animate({height: '460', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-5').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-6').click(function(){
	
	if 		($('#service-6').css('height') == '0px'){			  
	$('#service-6').animate({height: '460', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-6').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-7').click(function(){
	
	if 		($('#service-7').css('height') == '0px'){			  
	$('#service-7').animate({height: '1000', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-7').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});

$('#sb-8').click(function(){
	
	if 		($('#service-8').css('height') == '0px'){			  
	$('#service-8').animate({height: '840', overflow: 'hidden',}, 1000);
	}
	else {			  
	$('#service-8').animate({height: '0', overflow: 'hidden',}, 1000);
	}	
});




//====================== Start Up Settings ========================//					   
$('#icon_1').animate({
    top: '-20px',
	height: '86px',
  }, 100);
moveback()




//====================== mouse over Menu ========================//
$('#home').mouseover(function() {	  
  time = false;
  $('#arrow').animate({
    left: '311px',
  }, 300);
});
$('#about').mouseover(function() {
							  
  time = false;
  $('#arrow').animate({
    left: '430px',
  }, 300);
});
$('#services').mouseover(function() {
							  
  time = false;
  $('#arrow').animate({
    left: '580px',
  }, 300);
});
$('#events').mouseover(function() {
							  
  time = false;
  $('#arrow').animate({
    left: '710px',
  }, 300);
});
$('#contact').mouseover(function() {
							  
  time = false;
  $('#arrow').animate({
    left: '850px',
  }, 300);
});
//====================== mouse out of Menu ========================//
$('#home').mouseout(function() {
  time = true;  
  out_of = 1;
  setTimeout("goback1()", 3000);
});
$('#about').mouseout(function() {
  time = true; 
  out_of = 2; 
  setTimeout("goback2()", 3000);
});
$('#services').mouseout(function() {
  time = true;  
  out_of = 3;
  setTimeout("goback3()", 3000);
});
$('#events').mouseout(function() {
  time = true; 
  out_of = 4; 
  setTimeout("goback4()", 3000);
});
$('#contact').mouseout(function() {
								


  time = true;
  out_of = 5;  
  setTimeout("goback5()", 3000);
});

//====================== ========================//
$('#icon_1').mouseover(function() {
   $('this').animate({
    top: '-50px',
  }, 300);
});
$('#icon_1').mouseout(function() {
  $('this').animate({
    top: '0px',
  }, 300);
});


//====================== Icon Zoom ========================//
$('#icon_1').mouseover(function(){
$('#icon_1').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_2').mouseover(function(){
$('#icon_2').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_3').mouseover(function(){
$('#icon_3').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_4').mouseover(function(){
$('#icon_4').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_5').mouseover(function(){
$('#icon_5').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_6').mouseover(function(){
$('#icon_6').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_7').mouseover(function(){
$('#icon_7').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});

$('#icon_8').mouseover(function(){
$('#icon_8').animate({
    top: '-20px',
	height: '86px',
  }, 100);
});


$('#icon_1').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=1){						   
$('#icon_1').animate({
    top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_2').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=2){	
$('#icon_2').animate({
	top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_3').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=3){	
$('#icon_3').animate({    
	top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_4').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=4){		
$('#icon_4').animate({   
	top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_5').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=5){	
$('#icon_5').animate({    
	top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_6').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=6){		
$('#icon_6').animate({    
	top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_7').mouseout(function(){
							   
if (parseInt(x.charAt(5))!=7){		
$('#icon_7').animate({    					 
	top: '+10px',
	height: '66px',
  }, 100);
};});


$('#icon_8').mouseout(function(){
if (parseInt(x.charAt(5))!=8){		
$('#icon_8').animate({    
	top: '+10px',
	height: '66px',
  }, 100);
};});










});
//====================== ========================//	
function moveback(){
	if (menuitem == 1){
	$('#arrow').animate({
    left: '311px',
    }, 300);
	};
	
	if (menuitem == 2){
	$('#arrow').animate({
    left: '430px',
    }, 300);
	};
	
	if (menuitem == 3){
	$('#arrow').animate({
    left: '580px',
    }, 300);
	};
	
	if (menuitem == 4){
	$('#arrow').animate({
    left: '710px',
    }, 300);
	};
	
	if (menuitem == 5){
	$('#arrow').animate({
    left: '850px',
    }, 300);
	};
};
function goback1(){		
    if (time && out_of == 1){
		moveback();
	};
};
function goback2(){		
    if (time && out_of == 2){
		moveback();
	};
};
function goback3(){		
    if (time && out_of == 3){
		moveback();
	};
};
function goback4(){		
    if (time && out_of == 4){
		moveback();
	};
};
function goback5(){	
    if (time && out_of == 5){
		moveback();
	};
};

//====================== Icon Animations ========================//
var x;
function show(info){
  x = info;
 // document.getElementById('icon_info').style.height = '0px';
  //document.getElementById('icon_info').style.top = '163px';
  
  $('#icon_info').animate({
    top: '163px',
	height: '0px',
  }, 500);
  
  document.getElementById('icon_info').style.overflow = 'hidden';
  setTimeout("slideup()", 1000);
  
  
  if (parseInt(x.charAt(5))!=1){$('#icon_1').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=2){$('#icon_2').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=3){$('#icon_3').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=4){$('#icon_4').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=5){$('#icon_5').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=6){$('#icon_6').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=7){$('#icon_7').animate({top: '+10px',height: '66px',}, 100);}
  if (parseInt(x.charAt(5))!=8){$('#icon_8').animate({top: '+10px',height: '66px',}, 100);}
  

};

function slideup(){
	document.getElementById('info_1').style.display = 'none';
	document.getElementById('info_2').style.display = 'none';
	document.getElementById('info_3').style.display = 'none';
	document.getElementById('info_4').style.display = 'none';
	document.getElementById('info_5').style.display = 'none';
	document.getElementById('info_6').style.display = 'none';
	document.getElementById('info_7').style.display = 'none';
	document.getElementById('info_8').style.display = 'none';
	
	document.getElementById(x).style.display = 'block';


  //document.getElementById('icon_info').style.height = '163px';
  //document.getElementById('icon_info').style.top = '0px';
  
    $('#icon_info').animate({
    top: '0px',
	height: '163px',
  }, 500);
};

/*
function text1(){
	$('p').css('font-family', 'Verdana, Geneva, sans-serif');
	setTimeout("text2()", 100);
	
};
function text2(){
	$('p').css('font-family', 'Arial, Helvetica, sans-serif');
	setTimeout("text1()", 100);
	
	
};
setTimeout("text2()", 100);
setTimeout("text1()", 200);

*/