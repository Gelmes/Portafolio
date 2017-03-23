// JavaScript Document
 $(document).ready(function(){
 
 var imgArr = new Array( // relative paths of images
 'images/slide-1.jpg',
 'images/slide-2.jpg',
 'images/slide-3.jpg',
 'images/slide-4.jpg',
 'images/slide-5.jpg'
 );
 
  var slideArr = new Array( // relative paths of images
 '#slide-1',
 '#slide-2',
 '#slide-3',
 '#slide-4',
 '#slide-5'
 );
 
 var preloadArr = new Array();
 var i;
 
 /* preload images */
 for(i=0; i < imgArr.length; i++){
 preloadArr[i] = new Image();
 preloadArr[i].src = imgArr[i];
 }
 
 var currImg = 1;
 var intID = setInterval(changeImg, 9000);
 
 /* image rotator */
 function changeImg(){
 
 $('#slide-1').animate({opacity:0},1000);
 $('#slide-2').animate({opacity:0},1000);
 $('#slide-3').animate({opacity:0},1000);
 $('#slide-4').animate({opacity:0},1000);
 $('#slide-5').animate({opacity:0},1000);
 
 
 $('#slide-1').css("display","none"); 
 $('#slide-2').css("display","none"); 
 $('#slide-3').css("display","none"); 
 $('#slide-4').css("display","none"); 
 $('#slide-5').css("display","none");
  
 
 
 $("#home-slider").animate({opacity: 0}, 1000, function(){ 

/*
 $('#slide-1').css("display","none");
 $('#slide-2').css("display","none");
 $('#slide-3').css("display","none");
 $('#slide-4').css("display","none");
 $('#slide-5').css("display","none");
*/


 $(slideArr[currImg%preloadArr.length]).animate({opacity:1},1000);

 $(slideArr[currImg%preloadArr.length]).css("display","block");

 $(this).attr("src", preloadArr[currImg++%preloadArr.length].src);

 }).animate({opacity: 1}, 1000);
 
 }
 
 });