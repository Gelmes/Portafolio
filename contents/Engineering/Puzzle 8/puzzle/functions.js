
//////////////////////////////////////////////////////////////////////////////////
//
var Output = {
	canvas : document.getElementById("content"),
	print: function(value){
		this.canvas.innerHTML = value;
	}
}

var Node = {
	object : null,
	x: 0,
	y: 0,
	size: 20,
	init: function(canvas, id){
		canvas.innerHTML = canvas.innerHTML + "<div id='" + id + "'></div>";
		this.object = document.getElementById(id);
		this.object.style.position = "absolute";
		this.object.style.border = "solid 1px #000000";
		this.object.style.width = this.size + "px";
		this.object.style.height = this.size + "px";
		this.object.style.borderRadius = this.size/2 + "px";
		
	},
	setPos: function(x, y){
		this.object.style.top = (y-this.size/2) + "px";
		this.object.style.left = (x-this.size/2) + "px";
	}
}

var Connection = {
	object : null,
	x: 0,
	y: 0,
	w: 20,
	h: 20,
	init: function(canvas, id){
		canvas.innerHTML = canvas.innerHTML + "<hr id='" + id + "'>";
		this.object = document.getElementById(id);
		this.object.style.position = "absolute";
		this.object.style.border = "solid 1px #000000";
		this.object.style.width = this.w + "px";
		this.object.style.height = this.h + "px";
		this.object.style.transform = "rotate(7deg)";
		
	},
	setPos: function(x1, y1, x2, y2){
		this.object.style.top = y1 + "px";
		this.object.style.left = x1 + "px";
		this.object.style.width = this.w + "px";
		this.object.style.height = this.h + "px";
	}
}

var out = Object.create(Output);

var id = 0;
function createObject(x, y){	
	var obj = Object.create(Node);
	obj.init(out.canvas, id);
	obj.setPos(x, y);
	id++;
	return obj;
	//setTimeout(createObject,1000);
}

createObject(50,50);
createObject(100,100);

