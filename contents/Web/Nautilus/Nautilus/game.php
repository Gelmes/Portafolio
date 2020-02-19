
<!--
<div id="paper" style="width:100%; height:100%;">
<img id="sub" src="http://wiki.lbpcentral.com/images/thumb/5/52/Green_Submarine.png/120px-Green_Submarine.png" width="100px;" />
<div id="screenCoords"></div>
</div>
-->

<style>
#sub{
	display:block;
	position:absolute;
	left:0px;
	top:0px;
	z-index:2;
}
.missle{
	display:block;
	position:absolute;
	left:0px;
	top:0px;
	z-index:3;
	
}
.explosion{
	display:block;
	position:absolute;
	left:0px;
	top:0px;
	z-index:3;
	
}
</style>

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jQueryRotate.js"></script>
<script>
var xpos = 0;
var ypos = 0;
var speed = 0;
var sub_direction = 10;
var submarine = document.getElementById('sub');
var xspeed = 0;
var yspeed = 0;
var speed = .025;
var max_speed = 1;
var subx = 0;
var suby = 0; 
var threshold = 200;
var friction = .01;
var missle_count = 0;
var explosion_count = 0;
var missles = new Array();
var explosions = new Array();
var refresh_rate = 10;
var missle_sound = new Audio("sound/flyby.wav"); // buffers automatically when created
missle_sound.volume = .2;

var explosion_sound = new Audio("sound/blop.wav"); // buffers automatically when created
explosion_sound.volume = .2;

//////////////////////////////////////////////
//This function gets the position of the mouse
//on the screen
//////////////////////////////////////////////
function findScreenCoords(mouseEvent)
{
  if (mouseEvent)
  {
    //FireFox
    xpos = mouseEvent.pageX;
    ypos = mouseEvent.pageY;
  }
  else
  {
    //IE
    xpos = window.event.pageX;
    ypos = window.event.pageY;
  }
}
document.getElementById("page").onmousemove = findScreenCoords;

function explosion(id, x, y){	
	document.getElementById("paper").innerHTML = document.getElementById("paper").innerHTML + "<img class='explosion' id='" + id + "' src='http://clipartist.info/openclipart.org/SVG/cybergedeon/explosion-800px.png' width='100px' />";
	this.id = id;
	this.xpos = x;
	this.ypos = y;
	this.update = update;
	this.life_time = 10;
	this.timer = 0;
	delete explosion_sound;
	explosion_sound = new Audio("sound/blop.wav");
	explosion_sound.volume = .2;
	
	document.getElementById("" + this.id).style.left = this.xpos - 50;
	document.getElementById("" + this.id).style.top = this.ypos - 50;
					
	function update(){
		this.timer++;
		if(this.timer > this.life_time){
			$("#" + id).remove();				
			return 1;
		}
		return 0;
	}
	
	
}


function missle(id, xp, yp, d){
	document.getElementById("paper").innerHTML = document.getElementById("paper").innerHTML + "<img class='missle' id='" + id + "' src='http://static.pardus.at/img/std/equipment/missile2.png' width='32px' />";
	this.id = id;
	this.xpos = xp;
	this.ypos = yp;
	this.xspeed = 0;
	this.yspeed = 0;
	this.friction = .02;	
	
	this.blow_radious = 10;
	
	this.direction = d;
	this.turn_speed = 2;
	
	this.speed = 2;
	this.update = update;
	
	delete missle_sound;
	missle_sound = new Audio("sound/flyby.wav");
	missle_sound.volume = .2;
	
	function update(){
		
		var x = this.xpos - xpos;
		var y = this.ypos - ypos;
		
		if (  Math.sqrt(Math.pow(x,2) + Math.pow(y, 2)) < this.blow_radious  ){
				$("#" + id).remove();
				explosion_sound.play();
				explosions.push(new explosion("explosion" + explosion_count, this.xpos, this.ypos));
				explosion_count++;
				return 1;
		}
		
		var alpha = 0;
		//First we get the direction the sub needs
		//based on its angle between the sub and mouse
		
		if(x==0){
			alpha = 90;
		}
		else{
			alpha = Math.atan(y/x);		
		}
		
		//We convert from radians to degrees
		alpha = alpha*(180/Math.PI);
		
		
		//We fix some direction errors
		if(xpos < this.xpos){
			alpha += 180;
		}
		if (alpha < 0){
			alpha += 360;			
		}
		
		alpha -= this.direction;
		while(this.direction > 360){
			this.direction -= 360;
		}
		while(alpha > 360){
			alpha -= 360;
		}
		while(alpha < 0){
			alpha += 360;
		}
		
		if(alpha >180 ){
			this.direction -= this.turn_speed;
		}
		else if(alpha <180){
			this.direction += this.turn_speed;
			
		}
		
		//document.getElementById("screenCoords").innerHTML = this.direction + " " + alpha;
		
		//Sub image rotation is set							  
		$("#" + this.id).rotate(this.direction); //Direction and tilt of the sub
		
		
		//This motion is simple and no complex physics
		
		this.xspeed = this.speed * Math.cos(this.direction*(Math.PI /180));
		this.yspeed = this.speed * Math.sin(this.direction*(Math.PI /180));
		
		
		this.xpos += this.xspeed;
		this.ypos += this.yspeed;
		
		
  		//document.getElementById("screenCoords").innerHTML = xpos + ", " + ypos + " :: " + this.xpos + ", " + this.ypos;
		//Set the submarines new positions
		document.getElementById("" + this.id).style.left = this.xpos -  document.getElementById("" + this.id).width/2;
		document.getElementById("" + this.id).style.top = this.ypos - document.getElementById("" + this.id).height/2;
	}
}
//var missle = new missle("missle" + missle_count,100,100,0, 2)

///////////////////////////////////////////////
//This function gets the position of the mouse
//on the screen
///////////////////////////////////////////////
var game = setInterval(function(){
	
	
	
	//missle.update();
	var x = xpos - subx;
	var y = ypos - suby;
	
	//First we get the direction the sub needs
	//based on its angle between the sub and mouse
	if(x==0){
		sub_direction = 90;
	}
	else{
		sub_direction = Math.atan(y/x);		
	}
	
	//We convert from radians to degrees
	sub_direction = sub_direction*(180/Math.PI);
	
	//We fix some direction errors
	if(xpos < subx){
		document.getElementById('sub').src = "images/sub-left.png";
		sub_direction += 180;
		
		
		//Sub image rotation is set							  
		$("#sub").rotate(sub_direction - 180); //Direction and tilt of the sub
	}
	else{		
		document.getElementById('sub').src = "images/sub-right.png";
		
		
		//Sub image rotation is set							  
		$("#sub").rotate(sub_direction); //Direction and tilt of the sub
	}
	
	//This motion is simple and no complex physics
	/*
	xspeed = speed * Math.cos(sub_direction*(Math.PI /180));
	yspeed = speed * Math.sin(sub_direction*(Math.PI /180));
	subx += xspeed;
	suby += yspeed;
	*/
	
	//This motion is simple and no complex physics
	if(Math.abs(x) > threshold || Math.abs(y) > threshold ){
		xspeed += speed * Math.cos(sub_direction*(Math.PI /180));
		
		if(xspeed > max_speed){
			xspeed = max_speed;	
		}
		else if(Math.abs(xspeed) > max_speed){
			xspeed = -1 * max_speed;
		}
		
		yspeed += speed * Math.sin(sub_direction*(Math.PI /180));
		
		if(yspeed > max_speed){
			yspeed = max_speed;	
		}
		else if(Math.abs(yspeed) > max_speed){
			yspeed = -1 * max_speed;
		}
	}
	
	//Friction
	if(xspeed > 0){
		xspeed -= friction * Math.abs(Math.cos(sub_direction*(Math.PI /180)));
	}
	else if(xspeed < 0){
		xspeed += friction * Math.abs(Math.cos(sub_direction*(Math.PI /180)));
	}
	if(yspeed > 0){
		yspeed -= friction * Math.abs(Math.sin(sub_direction*(Math.PI /180)));
	}
	else if(yspeed < 0){
		yspeed += friction * Math.abs(Math.sin(sub_direction*(Math.PI /180)));	
	}
	
	subx += xspeed;
	suby += yspeed;
	
	//Set the submarines new positions
	document.getElementById('sub').style.left = subx -  document.getElementById('sub').width/2;
	document.getElementById('sub').style.top = suby - document.getElementById('sub').height/2;
	
	if (Math.floor((Math.random()*500)+1) == 1){	
			
		missle_sound.play();
		missles.push(new missle("missle" + missle_count,subx,suby,sub_direction));
		missle_count++;
	}
	
	for(var i=0; i < missles.length; i++){
		//Update returns true if missle has
		//collided with the mouse pointers
		//position
		if(missles[i].update()){
			//If the missle has collided its removed from
			//the array using the splice function
			missles.splice(i, 1);
		};
	}
	
	if (Math.floor((Math.random()*100)+1) == 1){	
		missles.push(new missle("missle" + missle_count,subx,suby,sub_direction));
		missle_count++;
	}
	
	for(var i=0; i < explosions.length; i++){
		
		if(explosions[i].update()){
			explosions.splice(i, 1);	
		};
		
	}
	
}, refresh_rate);



</script>
