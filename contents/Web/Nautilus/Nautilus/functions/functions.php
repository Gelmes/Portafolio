<?php

/*********************************************************************
*	Gets the content of the given file
*	and returns a string or characters
**********************************************************************/

function get_contents($address){
	$lines = file($address);
	$results = "";
	$results .= "<p>";
	// Loop through our array, show HTML source as HTML source; and line numbers too.
	foreach ($lines as $line_num => $line) {
		//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
		$results .= ($line) . "</p><p>";
	}
	
	$results .= "</p>";
	echo $results;
}


/*********************************************************************
*	Gets the content of the given file
*	and returns a string or characters
**********************************************************************/

function get_contents_limit($address, $limit){
	$lines = file($address);
	$results = "";
	$results .= "<p>";
	// Loop through our array, show HTML source as HTML source; and line numbers too.
	foreach ($lines as $line_num => $line) {
		//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
		$results .= ($line) . "</p><p>";
	}
	
	$results .= "</p>";
	echo substr($results,0,$limit);
}


/*********************************************************************
*	Gets the team members content
**********************************************************************/
function get_team(){
	
$folders =  scandir("team");

	foreach($folders as $folder){
		if(!($folder == "." || $folder == "..")){
			echo "<div id='member' class='shadow'>";
			$lines = file("team/".$folder."/bio.txt");		
			echo "<img src='team/".$folder."/bio.jpg' >";		
			echo "<h2>".$folder."</h2>";
			echo "<p>";
			foreach ($lines as $line_num => $line) {
				echo htmlspecialchars($line) . "</p><p>";
			}	
			echo "<p>";		
			echo "</div>";
		}		
	}
}

?>