var graph = {
  "nodes": [
    {"id": "red"},
    {"id": "orange"},
    {"id": "yellow"},
    {"id": "green"},
    {"id": "blue"},
    {"id": "violet"}
  ],
  "links": [
    {"source": "red", "target": "yellow"},
    {"source": "red", "target": "blue"},
    {"source": "red", "target": "green"}
  ]
}

var showCostValue = 0;

var margin = {top: -5, right: -5, bottom: -5, left: -5},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var zoom = d3.behavior.zoom()
    .scaleExtent([1, 10])
    .on("zoom", zoomed);

var drag = d3.behavior.drag()
    .origin(function(d) { return d; })
    .on("dragstart", dragstarted)
    .on("drag", dragged)
    .on("dragend", dragended);

	
var svg = d3.select("body").select("div.svg")
    .style("width", (width + margin.left + margin.right) + "px")
    .style("height", (height + margin.top + margin.bottom) + "px")
	.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.right + ")")
    .call(zoom);

var svg2 = d3.select("body").append("svg2")
    .style("width", width + margin.left + margin.right)
    .style("height", height + margin.top + margin.bottom)
	.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.right + ")");
	
var color = d3.scale.category10();

var nodes = [],
    links = [];

var force = d3.layout.force()
    .nodes(nodes)
    .links(links)
    .charge(-200)
	.gravity(0.2)
    .linkDistance(10)
    .size([width, height])
    .on("tick", tick);
	
	
function updateWindow(){
    var	w = window,
		d = document,
		e = d.documentElement,
		g = d.getElementsByTagName('body')[0],
		x = w.innerWidth || e.clientWidth || g.clientWidth,
		y = w.innerHeight|| e.clientHeight|| g.clientHeight;
    x = w.innerWidth || e.clientWidth || g.clientWidth;
    y = w.innerHeight|| e.clientHeight|| g.clientHeight;
	
    d3.select("body").select("div.svg").style("width", x + "px").style("height", y/2.25+ "px");
	force.size([x, y/0.75]).start();
}
window.onresize = updateWindow;
updateWindow();

//var svg = svg.append("g");
//var svg = d3.select("body").append("svg")
//    .attr("width", width)
//   .attr("height", height);

var link = svg.append("g").attr("id", "links").selectAll(".link"),
	node = svg.append("g").attr("id", "nodes").selectAll(".node");	
var text = svg.append("g").attr("id", "texts");
var costText = svg.append("g").attr("id", "costs");


/*
// 1. Add three nodes and three links.
setTimeout(function() {
  var a = {id: "a"}, b = {id: "b"}, c = {id: "c"};
  
  for(var i = 0; i < graph.nodes.length ; i++){ 
	nodes.push(graph.nodes[i]);	  
  }
  for(var i = 0; i < graph.links.length ; i++){
	//links.push(graph.links[i]);	  	  
  }
  
  nodes.push(a, b, c);
  links.push({source: a, target: b}, {source: a, target: c}, {source: b, target: c});
  //start();
}, 0);

// 2. Remove node B and associated links.
setTimeout(function() {
  nodes.splice(1, 1); // remove b
  links.shift(); // remove a-b
  links.pop(); // remove b-c
  //start();
}, 3000);

// Add node B back.
setTimeout(function() {
  var a = nodes[0], b = {id: "b"}, c = nodes[1];
  nodes.push(b);
  links.push({source: a, target: b}, {source: b, target: c});
  //start();
}, 6000);
*/


function start() {
	
	link = link.data(force.links(), function(d) { return d.source.id + "-" + d.target.id; });
	link.enter().insert("hr", ".node").attr("class", "link").attr("noshade", "");
	link.exit().remove();

	node = node.data(force.nodes(), function(d) { return d.id;});
	//node.enter().append("circle")
	node.enter().append("div")
		.attr("class", function(d) { return "node " + d.id + " " + d.state; })
		.attr("r", 10)
		.style("position", "absolute")
		.call(drag);
	node.exit().remove();
	force.start();
}

function tick() {
	node.style("left", function(d) { return (d.x) + "px"; })
		.style("top", function(d) { return (d.y) + "px"; })
		.attr("class", function(d) { return "node " + d.id + " " + d.state; })
		.html(function(d){return d.move});
	
	link
		.style("left", function(d){
			//var p1 = Math.pow((d.target.x - d.source.x), 2);
			//var p2 = Math.pow((d.target.y - d.source.y), 2);
			var p1 = (d.target.x - d.source.x);
			var p2 = (d.target.y - d.source.y);
			var add = p1 + p2;
			var scaling = Math.abs((d.source.y - d.target.y)/(Math.abs(d.source.y - d.target.y) + Math.abs(d.source.x - d.target.x)));
			//return (Math.sqrt(add) + "px");
			//return ((Math.max(d.source.x,d.target.x) + 12 - (Math.abs(d.source.y - d.target.y)/2)) + "px")})
			return ((Math.min(d.source.x,d.target.x) + 12 - scaling*(Math.abs(d.source.y - d.target.y)/2)) + "px")})
			//return ((Math.min(d.source.x,d.target.x) + 12) + "px")})
			//return ((Math.min(d.source.x,d.target.x) + 12 - Math.sqrt(add)/2) + "px")})
		.style("top", function(d){
			return  (Math.min(d.source.y,d.target.y) + Math.abs((d.source.y - d.target.y))/2) + "px"})
		.style("width", function(d) { 
			//console.log(d);
			//console.log(d.source.x + " - " + d.target.x + " = " +(d.target.x - d.source.x));
			var p1 = Math.pow((d.target.x - d.source.x), 2);
			var p2 = Math.pow((d.target.y - d.source.y), 2);
			var add = p1 + p2;
			//console.log(p1 + " + " + p2 + " = " + add);
			//console.log("sqrt = " + Math.sqrt(add));
			//return Math.floor(Math.abs(d.target.x - d.source.x))+ "px";
			return (Math.sqrt(add) + "px"); })
		//.style("transform-origin", "top left")
		.style("transform", function(d){return "rotate(" + Math.atan((d.target.y - d.source.y)/(d.target.x - d.source.x)) + "rad)"});
		
		
	
	var costTexts = costText.selectAll("div.costText").data(node[0]);		
	if(showCostValue){
		
		costTexts.attr("class",function(d){return "text"})
			.enter()
			.append("div");

		var textLabels = costTexts
			.attr("class",function(d){return "costText update"})
			.style("position", "absolute")
			.style("left", function(d){return (d.__data__.x+16) + "px";})
			.style("top", function(d){
				//console.log(d.__data__)
				return (d.__data__.y+16) + "px";})
			.html(function(d){return d.__data__.cost})
			
		costTexts.exit().remove();
	}
	else{		
		costTexts.attr("class",function(d){return "text"})
			.enter()
			.append("div");

		var textLabels = costTexts
			.attr("class",function(d){return "costText update"})
			.html("");
			
		costTexts.exit().remove();
	}
}

//________________________________________________________//
// 
// Create Links and nodes and update graph
// stops updating after a set amount of nodes
//________________________________________________________//
var identity = 0;
var renderActive = 1;
function updateGraph(Game){
	if(u.steps>1296){return -1;}
	else if(renderActive){
		//Clear current nodes
		while(nodes.length) nodes.pop();
		while(links.length) links.pop();
		identity = 0;
		addLinks(Game.tree);
		start();
	}
	Game.lastTree.parent.translate(Game.lastTree.parent.board);
	setUpClick(Game.lastTree.parent);
}

function renderOn(){
	renderActive = 1;
	d3.select(".rndon").attr("class", "waves-effect waves-light orange btn rndon");
	d3.select(".rndoff").attr("class", "waves-effect waves-light teal btn rndoff");
}

function renderOff(){
	renderActive = 0;
	d3.select(".rndon").attr("class", "waves-effect waves-light teal btn rndon");
	d3.select(".rndoff").attr("class", "waves-effect waves-light orange btn rndoff");
}


function showCost(choice){
	showCostValue = choice;
	if(!choice){
		d3.select(".scOn").attr("class", "waves-effect waves-light teal btn scOn");
		d3.select(".scOff").attr("class", "waves-effect waves-light orange btn scOff");
	}
	else{
		d3.select(".scOn").attr("class", "waves-effect waves-light orange btn scOn");
		d3.select(".scOff").attr("class", "waves-effect waves-light teal btn scOff");		
	}
	
	
}

function addLinks(Tree){
	identity++;
	
	var node = {id: identity, move: Tree.getMove(), state: Tree.getState(), cost: Tree.cumulativeCost};
	//If Tree has children
	for(var i = 0; i < Tree.children.length; i++){
		links.push({source: node, target: addLinks(Tree.children[i])});
	}	
	Tree.setIdentity(identity);
	nodes.push(node);
	
	
	/*
	if(!Tree.getIdentity()){
		var node = {id: identity, move: Tree.getMove(), state: Tree.getState()};
		for(var i = 0; i < Tree.children.length; i++){
			links.push({source: node, target: addLinks(Tree.children[i])});
		}	
		Tree.setIdentity(identity);
		nodes.push(node);
	}
	else{
		for(var i = 0; i < Tree.children.length; i++){
			if(!Tree.children[i].getIdentity()){
				nodes.sort(function(a,b){
					return a.id-b.id;
				})
				links.push({source: nodes[Tree.children[i].getIdentity()], target: addLinks(Tree.children[i])});
			}
			else{
				addLinks(Tree.children[i]);
			}
		}			
	}
	*/
	
	/*
	var found = 0;
	var x = 0;
	for(x = 0; x < nodes.length; x++){
		found = nodes[x].id == identity;
		if(found) break;
	}
	
	if(!found){
		var node = {id: identity};
		for(var i = 0; i < Tree.children.length; i++){
			links.push({source: node, target: addLinks(Tree.children[i])});
		}	
		Tree.setIdentity(identity);
		nodes.push(node);
		
	}
	else{
		for(var i = 0; i < Tree.children.length; i++){
			if(!Tree.children[i].getIdentity()){
				links.push({source: nodes[x], target: addLinks(Tree.children[i])});
			}
			else{
				addLinks(Tree.children[i]);
			}
		}	
	}
	*/
	
	/*
	var found = 0;
	var i = 0;
	for(i = 0; i < nodes.length; i++){
		found = nodes[i].id == nodes.length;
		if(found) break;
	}
	if(!found){
		nodes.push(node);
		for(var i = 0; i < Tree.children.length; i++){
			links.push({source: node, target: addLinks(Tree.children[i])});
		}	
	}
	else{
		for(var i = 0; i < Tree.children.length; i++){
			links.push({source: nodes[i], target: addLinks(Tree.children[i])});
		}			
	}
	*/
	return node;
}

function zoomed() {
  svg.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
}

function dragstarted(d) {
  d3.event.sourceEvent.stopPropagation();
  d3.select(this).classed("dragging", true);
}

function dragged(d) {
  d3.select(this).attr("cx", d.x = d3.event.x).attr("cy", d.y = d3.event.y);
  force.start();
}

function dragended(d) {
  d3.select(this).classed("dragging", false);
}
$(".button-collapse").sideNav({
      menuWidth: 300, // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: false // Choose whether you can drag to open on touch screens
});
$('.modal').modal();
	


