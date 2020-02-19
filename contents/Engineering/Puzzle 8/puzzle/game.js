
// var body = d3.select("body");

// var canvas = d3.select("body")
	// .append("svg")
	// .attr("width", 920)
	// .attr("height", 480);
	
// var circle = canvas
	// .append("circle")
	// .attr("cx", 25)
	// .attr("cy", 25)
	// .attr("r", 25)
	// .style("fill", "purple")

// var text = canvas
	// .append("text")
	// .style("fill", "white")
	// .attr("id", 10)
	// .attr("x", 10)
	// .attr("y", 30)
	// .text("One");

	
var	w = window,
	d = document,
	e = d.documentElement,
	gg = d.getElementsByTagName('body')[0],
	x = w.innerWidth || e.clientWidth || gg.clientWidth,
	y = w.innerHeight|| e.clientHeight|| gg.clientHeight;
windowWidth = w.innerWidth || e.clientWidth || gg.clientWidth;
windowHeight= w.innerHeight|| e.clientHeight|| gg.clientHeight;
var gblockWidth = windowWidth/4 - 11;
var gblockHeight = windowHeight/2.5/3 - 15;

//________________________________________________________//
// Used to clone objects
//________________________________________________________//
function clone(obj) {
    if (null == obj || "object" != typeof obj) return obj;
    var copy = obj.constructor();
    for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
    }
    return copy;
}
	
////////////////////////////////////////////////////////////////
//Class: Game object
function Game(){
	this.zx = 0;
	this.zy = 0;
	this.board = []; 
	this.blockWidth = 50;
	this.blockHeight = 50;
	this.posX = 10;
	this.posY = 10;
	this.width = 4;
	this.height = 3;
	this.padding = 2;
	this.boardSolution = [[1,2,3],[4,5,6],[7,8,0]];
	this.svg;
	this.depth = 15;
	//________________________________________________________//
	// Initializes the class
	//________________________________________________________//
	this.init = function(){
		//var r1 = 
		//var tempArray = [[1,2,3],[5,0,6],[4,7,8]];
		var tempArray = [[1,2,3],[0,4,7],[5,6,8]];
		//var tempArray = [[3,4,8],[2,5,6],[1,0,7]];
		//var tempArray = [[1,5,3],[4,0,6],[7,2,8]];
		this.board = tempArray;
		this.blockWidth = 50;
		this.blockHeight = 50;
		this.posX = 10;
		this.posY = 55;
		this.findEmpty();
		this.svg = svg;
		this.depth = 15
		this.getDepth();
	};
	
	//________________________________________________________//
	//Just returns the board same as game.board
	//________________________________________________________//
	this.getBoard = function(){
		return this.board;
	};
	
	//________________________________________________________//
	//Find location of the zero/empty block
	//________________________________________________________//
	this.findEmpty = function(){
		for(var y = 0; y < this.board.length; y++){
			for(var x = 0; x < this.board[y].length;x++){
				if(this.board[y][x] == 0){
					this.zx = x;
					this.zy = y;
				}
			}
		}
	};
	
	//________________________________________________________//
	//Find location of the zero/empty block
	//________________________________________________________//
	this.findLocation = function(board, val){
		for(var y = 0; y < board.length; y++){
			for(var x = 0; x < board[y].length;x++){
				if(board[y][x] == val){
					return [x,y];
				}
			}
		}
	};
	
	//________________________________________________________//
	// Grab values of HTML and use them as board values
	//________________________________________________________//
	this.grabBoard = function(){
		
		var arr = (d3.select("input.inputValues")[0][0].value).split(",");
		var i = 0;
		for(var y = 0; y < this.board.length; y++){
			for(var x = 0; x < this.board[y].length ;x++){
				this.board[y][x] = parseInt(arr[i]);
				i++;
			}
		}	
		try{
			if(i != (this.width * this.height)){			
				Materialize.toast("Invalid Input Board.. Randomizing", 3000);		
				this.randomize();
			}
			else{
				this.findEmpty();
				this.translate(this.board);
			}
		}
		catch(err){		
				Materialize.toast("Invalid Input Board.. Randomizing", 3000);
				console.log(err);
				this.randomize();			
		}
	};
	
	//___________________________________________________//
	// Sets the board, must create variables
	// to copy contents and not the referance
	//________________________________________________________//
	this.setBoard = function(board){
		//this.width = board[0].length;
		//this.height = board.length;
		this.createSize();
		//this.findEmpty();
		for(var y = 0; y < board.length; y++){
			for(var x = 0; x < board[y].length;x++){
				this.board[y][x] = board[y][x];
				if(this.board[y][x] == 0){
					this.zx = x;
					this.zy = y;
				}
			}
		}
	};
	
	//________________________________________________________//
	// Grab values of HTML and use them for the board size
	// the difference from this and updateSize is that
	// the canvas is redrawn
	//________________________________________________________//
	this.createSize = function(){
		try{
			var width =  (d3.select("input.puzzleWidth")[0][0].value);
			var height = (d3.select("input.puzzleHeight")[0][0].value);
			this.width = parseInt(width);
			this.height = parseInt(height);
			this.fillBoard();
			this.findEmpty();
		}
		catch(err){
			//console.log(err);
			return;
		}
	};
	
	//________________________________________________________//
	// Grab values of HTML and use them for the board size
	//________________________________________________________//
	this.updateSize = function(){
		
		var width = (d3.select("input.puzzleWidth")[0][0].value);
		var height = (d3.select("input.puzzleHeight")[0][0].value);
		d3.select("g.gameBoard").remove();
		this.width = parseInt(width);
		this.height = parseInt(height);
		this.fillBoard();
		gblockWidth = windowWidth/this.width - 11;
		gblockHeight = windowHeight/2.5/this.height - 15;
		this.createGUI(this.svg);
		this.translate(this.board);
		this.findEmpty();
	};
	
	this.fillBoard = function(){
		var newBoard = [];
		var newBoardsolution = [];
		var i = 1;
		for(var y = 0; y < this.height; y++){
			var col = [];
			var colSolution = [];
			for(var x = 0; x < this.width; x++){
				col.push(i);
				colSolution.push(i);
				i++;
			}
			newBoard.push(col);
			newBoardsolution.push(colSolution);
		}
		newBoard[this.height - 1][this.width - 1] = 0;
		newBoardsolution[this.height - 1][this.width - 1] = 0;
		
		this.boardSolution = newBoardsolution;
		this.board = newBoard;
		//this.randomize(10);
	}
	this.getDepth = function (){		
		this.depth = parseInt((d3.select("input.inputRandomDepth")[0][0].value));
	}
	//________________________________________________________//
	// Generate Random Puzzle
	//________________________________________________________//
	this.randomize = function(){
		//var depth = parseInt((d3.select("input.inputRandomDepth")[0][0].value));
	
		this.createSize();
		this.setBoard(this.boardSolution);
		var path = [];
		var lastMove = 0;
		var m = 1;
		var legalMove = 1;
		for(var i = 0; i < this.depth; i ++){
			legalMove = -1
			while(legalMove == -1){
				m = Math.floor((Math.random() * 10) + 1)%4;
				while(m == ((lastMove + 2) % 4)){
					m = Math.floor((Math.random() * 10) + 1)%4;
				}
				//console.log(m + " " + lastMove);
				lastMove = m;
				legalMove = this.move(m);
				if(legalMove != -1)path.push(m);
			}
		}
		
		var solution = [];
		//console.log("Path: " + path);
		for(var i = 0; i < path.length; i++){
			solution.push((path[path.length - i - 1]+2)%4);
			//Do we have a redundant solution
			//console.log("Solution: " + solution);
			//console.log("Redundancy " + i + ": " + solution[i] +  " " + (solution[i - 1]+2)%4);
			
			/*
			if(solution[i] == (solution[i - 1]+2)%4){
				//console.log("Redundancy: " + solution[i] == (solution[i+1]+2)%4);
				solution.pop();
				solution.pop();
			}
			*/
		}
		//if(solution.length > 6){
		//	Materialize.toast('I might freeze with this one!', 4000) 
		//}
		
		this.findEmpty();
		this.translate(this.board);
		return solution;
	};
	
	//________________________________________________________//
	//Find location of the zero/empty block
	//________________________________________________________//
	this.createGUI = function(container){
		
		if(this.svg) this.svg.select("g").select("gameBoard").remove();
		this.svg = container;
		var gameContainer = this.svg.append("g")
			.attr("class", "gameBoard")
		
		var gc1 = gameContainer
			.append("div")
			.attr("class", "mainRect")
			.style("left", this.posX + "px")
			.style("top", this.posY + "px")
			.style("width", (gblockWidth * this.width  + this.padding * (this.width + 3)) + "px")
			.style("height", (gblockHeight * this.height + this.padding * (this.height + 3)) + "px");
			
		/*
		var gc2 = gameContainer	
			.append("div")
			.attr("class", "mainRect")
			.style("left", (this.posX + this.blockWidth * (this.width + 1)) + "px")
			.style("top", this.posY + "px")
			.style("width", (this.blockWidth * this.width  + this.padding * (this.width + 2))  + "px")
			.style("height", (this.blockHeight * this.height + this.padding * (this.height + 2)) + "px");
		*/
		
		for(var y = 0; y < this.height; y++){
			for(var x = 0; x < this.width;x++){
				if(this.board[y][x] != 0){
					var val = this.board[y][x];
					var block = gc1.append("g");
					block.append("div")
						.attr("class", function(d){return "childRect teal item block-" + val})
						.style("left", (gblockWidth * x + this.padding * (x + 0.88)) + "px")
						.style("top", (gblockHeight * y + this.padding * (y + 0.88)) + "px")
						.html(this.board[y][x])
						.style("width", gblockWidth + "px")
						.style("height", gblockHeight + "px")
						.style("font-family", "sans-serif")
						.style("font-size", "20")
						.style("line-height", gblockHeight + "px")
				}
			}
		}
		/*
		for(var y = 0; y < this.height; y++){
			for(var x = 0; x < this.width;x++){
				if(this.board[y][x] != 0){
					var val = this.board[y][x];
					var block = gc2.append("g");
					block.append("div")
						.attr("class", function(d){return "childRect teal item blockSolution-" + val})
						.style("left", ((this.blockWidth * (x)) + this.padding * (x + 0.88)) + "px")
						.style("top", (this.blockHeight * y + this.padding * (y + 0.88)) + "px")
						.html(this.board[y][x])
						.style("width", this.blockWidth + "px")
						.style("height", this.blockHeight + "px")
						.style("font-family", "sans-serif")
						.style("font-size", "20")
						.style("line-height", this.blockHeight + "px")
						
				}
			}
		}
		*/
		
	};
	
	//________________________________________________________//
	// Translate
	//________________________________________________________//
	this.translate = function(destination){
		
		for(var y = 0; y < this.height; y++){
			for(var x = 0; x < this.width;x++){
				if(this.board[y][x] != 0){
							
					//alert(direction + " " + this.zy + " " + this.zx + " " + zy + " " + zx);
					
					//console.log(this);	
					//console.log(".block-"+this.board[zy][zx] + "  " + zy + "  " + zx + "  " + this.zy + "  " + this.zx + "  " + direction);	
					var block = this.svg.select(".gameBoard").select(".block-"+destination[y][x]);

					var valPosition = this.findLocation(destination, destination[y][x]); //find position of digit
					var px = ((gblockWidth * valPosition[0]) + this.padding * (valPosition[0] + 0.88)) + "px";
					var py = (gblockHeight * valPosition[1] + this.padding * (valPosition[1] + 0.88)) + "px";
					
					//console.log( "'.block-"+ source[y][x] + "' " + x + " " + y + " (" + valPosition + ") [" + source + "] [" + destination + "]");	
					block
						.transition()
						.duration(200)
						.style("left", px)
						.style("top", py);
				}
			}
		}
		
	};
	
	//________________________________________________________//
	//move array in a certain direction
	//________________________________________________________//
	this.move = function(direction){				
		zx = this.zx; //Only used for readability
		zy = this.zy; //Only used for readability
		try{
			switch(direction){
				case 0: //Move zero up
					this.board[zy][zx] = this.board[zy-1][zx]; 
					this.board[zy-1][zx] = 0; 
					this.zy = zy-1
					break;
				case 1: //Move zero right
					if((zx+2) > this.board[zy].length) return -1;
					this.board[zy][zx] = this.board[zy][zx+1]; 
					this.board[zy][zx+1] = 0;
					this.zx = zx+1
					break;
				case 2: //Move zero down
					this.board[zy][zx] = this.board[zy+1][zx]; 
					this.board[zy+1][zx] = 0;
					this.zy = zy+1
					break;
				case 3: //Move zero left
					if((zx-1) < 0) return -1;
					this.board[zy][zx] = this.board[zy][zx-1]; 
					this.board[zy][zx-1] = 0;
					this.zx = zx-1
					break;
			}
			return 0;
		}
		catch(err){ //If you try an unallowed move an error will triger
			return -1;
		}
	};
	
	this.init();
};
//End Class: Game object
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
//Class: Tree made to hold puzzles with a cost and children
function Tree(){
	this.parent = 0;
	this.children = [];
	this.path = [-1];
	this.cost = 0;
	this.singleCost = 0;
	this.manhattanCost = 0;
	this.misplacedCost = 0;
	this.cumulativeCost = 0;
	this.identity = 0;
	this.move = -1;
	//this.move = " ";
	this.state = "explored"
	
	//________________________________________________________//
	// Sets the children duh
	//________________________________________________________//
	this.setChildren = function(children){
		this.children = children;
	};
	
	//________________________________________________________//
	// Sets the parent duh
	//________________________________________________________//
	this.setParent = function(parent){
		this.parent = parent;
	};
	
	//________________________________________________________//
	// Sets the cost duh
	//________________________________________________________//
	this.setCost = function(cost){
		this.cost = cost;
	};
	
	//________________________________________________________//
	// Sets the cumulative cost duh
	//________________________________________________________//
	this.setCumulativeCost = function(cost){
		this.cumulativeCost = cost;
	};
	
	//________________________________________________________//
	// Sets the identity duh
	//________________________________________________________//
	this.setIdentity = function(identity){
		this.identity = identity;
	};
	
	//________________________________________________________//
	// Sets the identity duh
	//________________________________________________________//
	this.setMove = function(move){
		this.move = move;
	};
	
	
	//________________________________________________________//
	// Gets move duh
	//________________________________________________________//
	this.getMove = function(move){
		return this.move;
	};
	
	//________________________________________________________//
	// Gets node state
	//________________________________________________________//
	this.getState = function(){
		return this.state;
	};
	
	//________________________________________________________//
	// sets state
	//________________________________________________________//
	this.setState = function(state){
		this.state = state;
	};
	
	//________________________________________________________//
	// Sets the identity duh
	//________________________________________________________//
	this.getIdentity = function(){
		return this.identity
	};
	
	//________________________________________________________//
	// Gets the cost duh
	//________________________________________________________//
	this.getCost = function(){
		return this.cost;
	};
	
	//________________________________________________________//
	// Gets the Cumulativecost duh
	//________________________________________________________//
	this.getCumulativeCost = function(){
		return this.cumulativeCost;
	};
	
	//________________________________________________________//
	// Gets the cost duh
	//________________________________________________________//
	this.hasChildren = function(){
		return this.children.length;
	};
};
//End Class:
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Class: puzzleSolver for Num x Num - Puzzle game
// first argument is an instance of a game elementFromPoint
// second argument is the algorithem of choice
// Available Algorithems:
//  0 - Uniform Cost Search
//  1 - A * with the Misplaced Tile heuristic
//  2 - A * with the Manhattan Distance heuristic
function puzzleSolver(game){
	this.tree = 0;
	this.solution = [[1,2,3],[4,5,6],[7,8,0]];
	this.lastBoard = [[1,2,3],[4,5,6],[7,8,0]];
	this.nodes = [];
	this.maxNodeDepth = 0;
	this.lastTree;
	this.moveLabels = [" ","^",">","v","<"];
	this.path = [];
	this.depth = 0;
	this.depthLimit = 20;
	this.steps = 0;
	this.stepsLimit =   this.depthLimit *  
						this.depthLimit *  
						this.depthLimit *  
						this.depthLimit; //branching factor stuff 
	this.mode = 2;
	this.finished = 0;
	this.solutions = [];
	this.collissionsCouter = 0;
	

	//________________________________________________________//
	// Sets the gameboard so manipulations can be done on it
	//________________________________________________________//
	this.init = function(game){
			
		this.finished = 0;
		this.nodes = [];
		this.maxNodeDepth = 0;
		this.steps = 0;
		this.tree = new Tree();
		this.tree.parent = game;
		this.tree.setState("start");
		this.tree.setCumulativeCost(0);
		this.tree.setCost(1);
		this.tree.singleCost = 1;
		this.lastTree = this.tree;
		this.lastBoard = game.board;
		this.solution = game.boardSolution
		this.solutions = [];
		this.collissionsCouter = 0;
		
		//console.log("Initiated " + this.moveLabels);
		/*
		if(this.mode == 0){
			console.log("Started ");
			this.tree.setCost(1);
		}
		else if(this.mode == 1){
			this.tree.setCost(this.getCost(game, 0));			
		}
		else if(this.mode == 2){
			this.tree.setCost(this.getCost(game, 1));			
		}
		*/
		this.nodes.push(this.tree);
		
	};
	
	this.collissionCheck = function(board){
		for(var b = 0; b < this.solutions.length; b++){
			//console.log(board);
			var collisions = 0;
			for(var y = 0; y < board.length; y++){
				for(var x = 0; x < board[y].length; x++){
					if(this.solutions[b][y][x] == board[y][x]){
						collisions++;
					}
					else{ //Exit this search
						y = board.length - 1;
						x = board[0].length - 1;
					}
					if(collisions == (board.length * board[y].length)){
						return 1;
					}
					
				}
			}
		}
		//console.log(collisions);
		this.solutions.push(board);
		return 0;
	}
	
	//________________________________________________________//
	// 
	// Expand the branch next in queue
	//________________________________________________________//
	this.expand = function(){
		
		if(this.finished == 1){return 0;}
		var node = this.nodes.pop(); // Trees pop here
		
		var children = [];
		//console.log(this.lastTree);
		//try{this.lastTree.setState("explored")}catch(err){};
		if(this.lastTree.getMove() != -1){this.lastTree.setState("explored")};
		if(node.getMove() != -1){node.setState("current")};
		//if(node.singleCost == 0)this.wonGame(node);	
		
		
		for(var i = 0; i < 4; i++){
			if(node.parent.move(i) == 0){   //Is it a legal move
				//Create new tree object to save state
				//Create child to inherit parents state
				var child = new Game;
				child.createSize();
				child.setBoard(node.parent.board);
				
				var tree = new Tree;
				tree.setParent(child);
				if(this.mode == 0){ //Uniform Cost Search
					//console.log(0 + " " + node.getCumulativeCost());
					tree.singleCost = this.getCost(child, 0);
					tree.setCumulativeCost(1 + node.getCumulativeCost());
					tree.setCost(1 + tree.getCumulativeCost());//this.getCost(child, 1));
				}
				else if(this.mode == 1){ //A* With misplace tile
					//console.log(1 + " " + node.getCumulativeCost());
					tree.singleCost = this.getCost(child, 0);
					tree.misplacedCost = this.getCost(child, 0);
					tree.setCumulativeCost(tree.misplacedCost + node.getCumulativeCost());
					tree.setCost(tree.getCumulativeCost());
				}
				else if(this.mode == 2){ //A* With Manhattan Distance
					//console.log(2 + " " + node.getCumulativeCost());
					tree.singleCost = this.getCost(child, 1);
					tree.manhattanCost = this.getCost(child, 1);
					tree.setCumulativeCost(tree.manhattanCost + node.getCumulativeCost());
					tree.setCost(tree.getCumulativeCost());
				}
				
				//tree.setMove(this.moveLabels[i+1]);
				tree.setMove(i);
				tree.path.push(i);
				this.depth = Math.max(this.depth, node.path.length);
				
				var newPath = node.path.slice();
				newPath.push(i);
				tree.path = newPath;
				
				tree.setState("unexplored");
				node.children.push(tree); //save children
				node.parent.move((i+2)%4);  	 //move node back
				
				this.nodes.push(tree);   //Add to queue list
				//console.log(this.maxNodeDepth + " " + this.nodes.length);
						
				
			}
		}	
		
		//console.log(this.lastBoard, node.parent.board);
		//node.parent.translate(this.lastBoard, node.parent.board);
		//*node.parent.translate(node.parent.board);
		this.lastBoard = node.parent.board;
		this.lastTree = node;
		this.maxNodeDepth = Math.max(this.maxNodeDepth, this.nodes.length);		
		if(node.singleCost == 0)this.wonGame(node);	
		this.steps++; //this contains the solution depth/steps
		//console.log(this.lastBoard + " " + this.collisionCheck(this.lastBoard));
		
		if(this.collissionCheck(this.lastBoard)){
			this.collissionsCouter++;
		}
		else{
			this.collissionsCouter = 0;
		}
		if(this.collissionsCouter > 500){			
			Materialize.toast('Too Many Collisions!', 4000) 
			Materialize.toast('This Puzzle is likely Unsolvable!', 4000) 
			this.finished = 1;
		}
		
		if(this.nodes.length){ //If we have branches to explore
			//sort branches by g(x) cost
			this.nodes.sort(function(a, b){
				return b.getCumulativeCost() - a.getCumulativeCost();
			});			
		}
		//*updateGraph(this.tree);
		return 0;
	};
	
	this.legalMove = function(tree, move){		
		var results = -1;
		for(var i = 0; i < tree.children.length;i++){
			if(tree.children[i].move == move) return i;
		}
		return -1;
	}
	
	//________________________________________________________//
	// 
	// Moves Puzzle
	//________________________________________________________//
	this.movePuzzle = function(direction){
		
		var move = this.legalMove(this.lastTree, direction);
		if(move != -1){
			var node = this.lastTree.children[move];
			//console.log(node);
			if(node.getMove() != -1){node.setState("current")};	
			
			if(this.finished == 1){return 0;}	
			var children = [];
			//console.log(this.lastTree);
			if(this.lastTree.getMove() != -1){this.lastTree.setState("explored")};
			for(var i = 0; i < 4; i++){
				if(node.parent.move(i) == 0){   //Is it a legal move
					//Create new tree object to save state
					//Create child to inherit parents state
					var child = new Game;
					child.createSize();
					child.setBoard(node.parent.board);
					var tree = new Tree;
					tree.setParent(child);
					if(this.mode == 0){ //Uniform Cost Search
						//console.log(0 + " " + node.getCumulativeCost());
						tree.singleCost = this.getCost(child, 0);
						tree.setCumulativeCost(1 + node.getCumulativeCost());
						tree.setCost(1 + tree.getCumulativeCost());//this.getCost(child, 1));
					}
					else if(this.mode == 1){ //A* With misplace tile
						//console.log(1 + " " + node.getCumulativeCost());
						tree.singleCost = this.getCost(child, 0);
						tree.misplacedCost = this.getCost(child, 0);
						tree.setCumulativeCost(tree.misplacedCost + node.getCumulativeCost());
						tree.setCost(tree.getCumulativeCost());
					}
					else if(this.mode == 2){ //A* With Manhattan Distance
						//console.log(2 + " " + node.getCumulativeCost());
						tree.singleCost = this.getCost(child, 1);
						tree.manhattanCost = this.getCost(child, 1);
						tree.setCumulativeCost(tree.manhattanCost + node.getCumulativeCost());
						tree.setCost(tree.getCumulativeCost());
					}				
					//tree.setMove(this.moveLabels[i+1]);
					tree.setMove(i);
					tree.path.push(i);
					this.depth = Math.max(this.depth, node.path.length);
					
					var newPath = node.path.slice();
					newPath.push(i);
					tree.path = newPath;
					
					tree.setState("unexplored");
					node.children.push(tree); //save children
					node.parent.move((i+2)%4);  	 //move node back
					
					this.nodes.push(tree);   //Add to queue list
					//console.log(this.maxNodeDepth + " " + this.nodes.length);
							
					
				}
			}	
		
			//console.log(this.lastBoard, node.parent.board);
			//node.parent.translate(this.lastBoard, node.parent.board);
			//node.parent.translate(node.parent.board);
			this.lastBoard = node.parent.board;
			this.lastTree = node;
			this.maxNodeDepth = Math.max(this.maxNodeDepth, this.nodes.length);		
			if(node.singleCost == 0)this.wonGame(node);	
			this.steps++; //this contains the solution depth/steps
			
			if(this.nodes.length){ //If we have branches to explore
				//sort branches by g(x) cost
				this.nodes.sort(function(a, b){
					return b.getCumulativeCost() - a.getCumulativeCost();
				});			
			}
			//updateGraph(this.tree);
		}
		return 0;
	};
	
	//________________________________________________________//
	// 
	// Set the mode
	//________________________________________________________//
	this.setMode = function(mode){
		this.mode = mode;
	};
	
	//________________________________________________________//
	// 
	// determine if path is in the right direction
	//________________________________________________________//
	this.findDivergence = function(state1, state2){
		var i = 0;
		try{
			while(state1[i] == state2[i] && i < state1.length) i++;
			return state2.slice(i,state2.length);
		}
		catch(err){
				console.log(err);
		}
	};
	
	//________________________________________________________//
	// 
	// Calculate the cost using the given algorithem
	//________________________________________________________//
	this.getCost = function(state, heuristic){
		if(heuristic == 1){ //Manhattan Distance
			var i = 0; //holds the current number being compared
			var cost = 0;
			for(var y = 0; y < state.board.length; y++){
				for(var x = 0; x < state.board[y].length; x++){
					if(state.board[y][x] != 0){
						var position = this.findCoordinates(state.board[y][x]);
						cost += Math.abs(x-position[0]) + 
								Math.abs(y-position[1]);
						i++;
					}
				}
			}
		}
		else if(heuristic == 0){ //Misplaced tiles
			var i = 0; //holds the current number being compared
			var cost = 0;
			for(var y = 0; y < state.board.length; y++){
				for(var x = 0; x < state.board[y].length; x++){
					cost += state.board[y][x] != this.solution[y][x];
				}
			}
		}
		return cost;
	};
	
	//________________________________________________________//
	// 
	// Finds the coordinates of the given value
	//________________________________________________________//
	this.findCoordinates = function(val){
		for(var y = 0; y < this.solution.length; y++){
			for(var x = 0; x < this.solution[y].length; x++){
				//When found return coordinates
				if(this.solution[y][x] == val){
					return [x, y]; 
				}
			}
		}
	};

	//________________________________________________________//
	// 
	// Won Game
	//________________________________________________________//
	this.wonGame = function(node){
		node.setState("winner");
		//console.log("Nodes expanded: " + this.steps);
		//console.log("     Max nodes: " + this.maxNodeDepth);
		//console.log("Solution depth: " + this.depth);
		//console.log("      Solution: " + node.path);
		d3.select(".results").html(
			"Puzzle Array ------ : " + this.tree.parent.board + "<br/>" +
			"Nodes expanded : " + this.steps + "<br/>" +
			"Max nodes -------- : " + this.maxNodeDepth + "<br/>" +
			"Solution depth --- : " + this.depth + "<br/>" +
			"Solution ------------ : " + node.path.slice(1,node.path.length)
		);
		Materialize.toast('Solution: ' + node.path.slice(1,node.path.length), 8000) 
		this.finished = 1;
	};

	//________________________________________________________//
	// 
	// Solve Game
	//________________________________________________________//
	this.solve = function(){
		while(this.finished == 0){
			this.expand();
			if(this.steps >= this.stepsLimit){this.finished = 2};
			if(this.depth >= this.depthLimit){this.finished = 3};
			//console.log("Solving... " + this.steps + " " + this.stepsLimit + " " + this.finished);
		}
		if(this.finished == 2){
			console.log("Reached steps limit of " + this.stepsLimit + " depth: " + this.depth);			
			d3.select(".results").html("Reached steps limit of " + this.stepsLimit + " depth: " + this.depth);
		}
		else if(this.finished == 3){
			console.log("Reached depth limit of " + this.depthLimit + " depth: " + this.depth);
			d3.select(".results").html("Reached depth limit of " + this.depthLimit + " depth: " + this.depth);
		}
		//updateGraph(this.tree);
	};	
	
	this.init(game);
}
//End Class: puzzleSolver (Uniform Cost Search)
////////////////////////////////////////////////////////////////


var g = 0;
var u = 0;
var mode = 1;

function setMode(m){
	console.log(".alg" + m);
	d3.select(".alg" + m          ).attr("class", "orange waves-effect waves-light btn alg" + (m));
	d3.select(".alg" + ((m + 1) % 3)).attr("class", "teal waves-effect waves-light btn alg" + ((m+1)%3));
	d3.select(".alg" + ((m + 2) % 3)).attr("class", "teal waves-effect waves-light btn alg" + ((m+2)%3));
	mode = m;
}

function initTest(){
	g = new Game();
	console.log("############# Starting ##############");
	console.log("Solution: " + g.randomize());
	
	//g.blockWidth = x/g.width - 11;
	//g.blockHeight = y/3/g.height - 15;
	
	g.createGUI(svg);
	u = new puzzleSolver(g);
	u.setMode(mode);
	u.expand();
	updateGraph(u);
	//setUpTouch("mainRect");
}
initTest();

function solvePuzzle(){
	u.solve();
	updateGraph(u);
}

function stepPuzzle(){
	u.expand();
	updateGraph(u);
}

function runTest(){
	for(var i = 1; i < 11; i++){
		depthSpeed(5000, i);
	}
	
}

function depthSpeed(tests, depth){
	var nodesExpanded1 = 0;
	var maxNodes1 = 0;
	var solutionDepth1 = 0;
	var counter = 0;
	console.log("-------------------------");
	//console.log("Running Uniform Cost Test");
	var start = new Date();
	for(var t = 0; t < tests; t++){
		g = new Game();
		g.depth = depth;
		g.randomize();				
		u = new puzzleSolver(g);		
		u.setMode(0);
		u.solve();
		nodesExpanded1 += u.steps;
		maxNodes1 += u.maxNodeDepth;
	    solutionDepth1 += u.depth;
		//counter++;
	    //console.log(counter + ", ");
	}
	var elapsed1 = new Date() - start;
	//console.log("Average Nodes Expanded Uniform  : " + nodesExpanded1/tests);
	
	var nodesExpanded2 = 0;
	var maxNodes2 = 0;
	var solutionDepth2 = 0;
	counter = 0;
	//console.log("-------------------------");
	//console.log("A * Misplaced Tile");
	var start = new Date();
	for(var t = 0; t < tests; t++){
		g = new Game();
		g.depth = depth;
		g.randomize();				
		u = new puzzleSolver(g);		
		u.setMode(1);
		u.solve();
		nodesExpanded2 += u.steps;
		maxNodes2 += u.maxNodeDepth;
	    solutionDepth2 += u.depth;
		//counter++;
	    //console.log(counter + ", ");
	} 
	var elapsed2 = new Date() - start;
	//console.log("Average Nodes Expanded Misplaced: " + nodesExpanded2/tests);
	
	var nodesExpanded3 = 0;
	var maxNodes3 = 0;
	var solutionDepth3 = 0;
	counter = 0;
	//console.log("-------------------------");
	//console.log("A * Manhattan Distance");
	var start = new Date();
	for(var t = 0; t < tests; t++){
		g = new Game();
		g.depth = depth;
		g.randomize();				
		u = new puzzleSolver(g);		
		u.setMode(2);
		u.solve();
		nodesExpanded3 += u.steps;
		maxNodes3 += u.maxNodeDepth;
	    solutionDepth3 += u.depth;
		//counter++;
	    //console.log(counter + ", ");
	}
	var elapsed3 = new Date() - start;
	//console.log("Average Nodes Expanded Manhattan: " + nodesExpanded3/tests);
	
	console.log("nodesExpanded " + tests + " " + depth +  " " + nodesExpanded1/tests + " " + nodesExpanded2/tests + " " + nodesExpanded3/tests + " maxNodes " + tests + " " + depth +  " " + maxNodes1/tests + " " + maxNodes2/tests + " " + maxNodes3/tests + " solDepth " + tests + " " + depth +  " " + solutionDepth1/tests + " " + solutionDepth2/tests + " " + solutionDepth3/tests + " timeElapsed " + tests + " " + depth +  " " + elapsed1 +  " " + elapsed2 +  " " + elapsed3);
}

function randomGame(){
	g = new Game();
	console.log("############# Starting ##############");
	console.log("Solution: " + g.randomize());		
	u = new puzzleSolver(g);
	u.setMode(mode);
	u.expand();
	updateGraph(u);
}

function sendPuzzle(){
	var width = g.width;
	var height = g.height;
	g = new Game();
	g.width = width;
	g.height = height;
	g.updateSize();
	console.log("############# Starting ##############");	
	g.grabBoard();	
	u = new puzzleSolver(g);
	u.setMode(mode);
	u.expand();	
	updateGraph(u);	
	return;
}

function resetPuzzle(){
	g = new Game();
	console.log("############# Starting ##############");
	g.setBoard(u.tree.parent.board);	
	u = new puzzleSolver(g); 
	u.setMode(mode);
	u.expand();	
	updateGraph(u);	
}

function puzzleSize(){
	g = new Game();
	console.log("############# Starting ##############");
	g.updateSize();
	console.log("Solution: " + g.randomize());	
	u = new puzzleSolver(g);
	u.setMode(mode);
	u.expand();	
	updateGraph(u);	
	//setUpTouch("mainRect");
}

function up(){
	u.movePuzzle(0);	
	updateGraph(u);
}
function down(){
	u.movePuzzle(2);
	updateGraph(u);	
}
function left(){
	u.movePuzzle(1);
	updateGraph(u);	
}
function right(){
	u.movePuzzle(3);	
	updateGraph(u);
}
         
function setUpTouch(classValue){		 
	$("." + classValue).touchwipe({
		 wipeLeft: function() { left(); },
		 wipeRight: function() { right(); },
		 wipeUp: function() { up(); },
		 wipeDown: function() { down(); },
		 min_move_x: 20,
		 min_move_y: 20,
		 preventDefaultEvents: true
	});
}

function setUpClick(Game){
	try{
		var block = this.svg.select(".gameBoard").select(".block-"+Game.board[Game.zy + 1][Game.zx]);
		block.attr("onclick","down()");
	}catch(err){}
	
	try{
		var block = this.svg.select(".gameBoard").select(".block-"+Game.board[Game.zy - 1][Game.zx]);
		block.attr("onclick","up()");
	}catch(err){}
	
	try{
		var block = this.svg.select(".gameBoard").select(".block-"+Game.board[Game.zy][Game.zx + 1]);
		block.attr("onclick","left()");
	}catch(err){}
	
	try{
		var block = this.svg.select(".gameBoard").select(".block-"+Game.board[Game.zy][Game.zx - 1]);
		block.attr("onclick","right()");
	}catch(err){}
}