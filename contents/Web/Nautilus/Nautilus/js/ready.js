
function appendHTML (id, html){
	document.getElementById(id).innerHTML = document.getElementById(id).innerHTML + html;	
}

function ready(){
	appendHTML(menu_item,"<div style='height:1px; background:#009999;'></div>");
	//setInterval(theGame(),5000);
	if (Math.floor((Math.random()*10)+1) != 1){
		clearInterval(game);
		document.getElementById("paper").innerHTML = "";
		//alert("no sub");
	}
	else{	
		$("#home_video").remove();		
		//alert("with sub");
		$('#slideshow div:first').fadeOut(1000);
		$('#slideshow div:first').next().fadeIn(1000).end();
	}
	//////////////////////////////////////////////
	
	var end = new Date('7/28/2014 12:00 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('timer').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('timer').innerHTML = days + ':';
        document.getElementById('timer').innerHTML += hours + ':';
        document.getElementById('timer').innerHTML += minutes + ':';
        document.getElementById('timer').innerHTML += seconds + '';
    }

    timer = setInterval(showRemaining, 1000);	
	
	/////////////////////////////////////////////
	
}


var tid = setInterval(function(){
	if(document.readyState !== "complete") return;
	clearInterval(tid);
	ready();
	},100);

