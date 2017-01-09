
function fadeInElement(el){
	//$(el).fadeIn(Math.random()*5000);
	Materialize.fadeInImage($(el));
};

function initHandlers(){
	$(".parallax-bg")
}
//On a click load that items data
$( document ).ready(function() {
	//alert("Hilo");
	//var options = [{selector: '.parallax-bg', offset: 0, callback: "alert('Meow')" }];
	//alert("Hi");
	//Materialize.scrollFire([{selector: '.parallax-bg', offset: 50, callback: fadeInElement }]);
	//fadeInElement();
    //$(".parallax-bg").each(function() {
    //  $(this).fadeIn(Math.random()*5000);
    // 	$(this).slideToggle( Math.random()*5000);
    //});

		$('html, body').animate({ scrollTop: 1 }, 1); //Gotta do this so the animation gets triggered
    $('html, body').animate({ scrollTop: 0 }, 1); //Gotta do this so the animation gets triggered

    //Setting up the scrollfire animation
		/*
    var i = 0;
    $(".parallax-bg").each(function() {
    	i++;
    	Materialize.scrollFire([{selector: "#coloumn-"+i, offset: 10, callback: fadeInElement }]);
    	//Materialize.scrollFire([{selector: "#coloumn-"+i, offset: 10, callback: fadeOutElement }]);
    });
		*/

		$(".parallax-bg").hover(function(){
    //$(this).children().css("float", "none");
    $(this).children(".selection").fadeIn("slow");
    //$(this).css("border", "#222222 solid 3px");
    }, function(){
    //$(this).children().css("float", "right");
    $(this).children(".selection").fadeOut("slow");
    //$(this).css("border", "none");
		});

		$('.carousel.carousel-slider').carousel({full_width: true});
});
