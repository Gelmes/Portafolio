
|   | Last Updated 3/4/2017 |
|-------------|------------:|
### Puzzle 8 Solver
###### by Marco Rubio

The goal of this project is to develop an algorithm that can be used to solve the Puzzle 8 game using one of three algorithms: uniform cost search, A * using the misplaced tile heuristic, A * with the Manhattan distance heuristic. The puzzle should be easy to convert to a size 15 or 26 puzzle. It must also be possible to change the values within the puzzle in some way. A trace of the puzzle shown to the right must also be demonstrated. [Click me to check it out!!](/contents/CS%20Engr/Puzzle%208/puzzle)
####Results
#####Language Choice
The solution chosen for this project was coded using JavaScript, HTML, and CSS. I chose these languages as they would allow me to later easily create an app and to create a GUI. 
#####Data Structures
The data structure of choice was a directional tree. This means that there would be a parent node along with its children to determine the choices made by the program. 
The nodes are queued in a simple array and sorted by their cumulative cost as to pick the node with the least cost.
#####Strategy
To solve the puzzle, we first initialize all the variables required, this includes the tree and its parent. The tree would contain the parent node made of an object containing the board state at the time of its creation. At each iteration, the next node on the queue would be pulled and its children generated based on the possible moves that can be made. As these children are generated the cost of each is determined based on the algorithm selected. There is a limit set to both the depth and the number of steps that can be taken in any puzzle and an error message will be printed if such case is found. If any node is found to have a cost of zero, then we know we have found a solution and the results are printed to the user in the GUI and in the console.
#####Algorithms
The fallowing code snippets show the main section of my code that decide what algorithm to use and how to is saves the calculated cost of each state.
The Uniform Cost Search simply adds 1 to the cumulative cost to  determine what node to pick next.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                if(this.mode == 0){ //Uniform Cost Search
                    //console.log(0 + " " + node.getCumulativeCost());
                    tree.singleCost = this.getCost(child, 0);
                    tree.setCumulativeCost(1 + node.getCumulativeCost());
                    tree.setCost(1 + tree.getCumulativeCost());//this.getCost(child, 1));
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                }
The A * With the misplaced tile algorithm calculates the misplaced tile cost before saving it to the cumulative cost. Previous nodes cumulative cost is used to determine current nodes cumulative cost.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                else if(this.mode == 1){ //A* With misplace tile
                    //console.log(1 + " " + node.getCumulativeCost());
                    tree.singleCost = this.getCost(child, 0);
                    tree.misplacedCost = this.getCost(child, 0);
                    tree.setCumulativeCost(tree.misplacedCost + node.getCumulativeCost());
                    tree.setCost(tree.getCumulativeCost());

                }
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
The A * with Manhattan Distance algorithm works the same as the misplaced tile version except that it calculates the cost based on the Manhattan Distance.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    else if(this.mode == 2){ //A* With Manhattan Distance
                    //console.log(2 + " " + node.getCumulativeCost());
                    tree.singleCost = this.getCost(child, 1);
                    tree.manhattanCost = this.getCost(child, 1);
                    tree.setCumulativeCost(tree.manhattanCost + node.getCumulativeCost());
                    tree.setCost(tree.getCumulativeCost());
                }
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
####Tracing Manhattan distance
The image to the right shows the generated search tree along with the cost calculated at each node labeled next to each node. The orange node with the value of -1 is the starting node, and the green node is the final node. Any black nodes have already been traversed. All white nodes are nodes that still need to be explored and are on the queue list.
The values at each node state dictate the direction that the 'blank' space is moved given the fallowing configuration: 
0 - Move blank space up
1 - Move blank space right
2 - Move blank space down
3 - Move blank space left

This graph is equivalent as showing the trace of the problem as it displays some of the decisions made by the algorithm along with the costs at each node. When trying to solve the problem Provided by this lab, the solution would never be found Indicating an unsolvable problem.


####Tree Structures
For the puzzle problem to the right it was really interesting to see the different tree sizes that were generated by the three algorithms. You can see below in order the Uniform Cost Search, A * with Misplaced Tile, and A * with Manhattan Distance trees.
It's clearly visible that the Manhattan distance is the most optimal in this problem, and show to be the most optimal for most cases during the tests.
####Test Results
A total of 5000 tests per algorithm was done with each test incrementing the maximum puzzle solution depth by one from one to ten. The three results that were taken into consideration was the Maximum number of nodes on the queue, the number of nodes expanded, and the average time taken to solve each problem.
![Image](/contents/CS%20Engr/Puzzle%208/tr1.JPG '100x100')
![Image](/contents/CS%20Engr/Puzzle%208/tr2.JPG '100x100')
![Image](/contents/CS%20Engr/Puzzle%208/tr2.JPG '100x100')
The graphs shown are displayed in a logarithmic scale to show the differences between results better. As you can see from the graphs the UCS algorithm was the slowest. Both the Misplaced tile and the Manhattan distance algorithms did well with the Manhattan distance being faster.

