<?php

include("Parsedown.php");
include("ParsedownExtra.php");

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

/*********************************************************************
*	Generates HTML for projects thumbnails
*   Uses the folder title as the banner
*   title and uses an image titled
*   thumb.jpg as the thumbnail
**********************************************************************/
function get_projects($address, $divided=1, $counter=0){

  $folders =  scandir($address);
  if($divided == 1) echo "<div class='row'>";
	foreach($folders as $folder){
		if(!($folder == "." || $folder == "..") && is_dir($address.'/'.$folder)){
			if(file_exists($address.'/'.$folder.'/thumb.jpg')){
				$counter++; //Incremented each time to give each element a unique ID
				echo '<div class="col s12 m4 filter">';
				echo '<a href="./content.php?dir=';
				echo $address.'/'.$folder;
				echo '">';
				echo '<div id="coloumn-'.$counter.
							'" class="parallax-bg" style="background-image: url('.
							"'".$address.'/'.$folder.'/thumb.jpg'."'";
				echo	'); z-index: -1;"><div class="title-text">'.
				//echo	'); opacity: 0; z-index: -1;"><div class="title-text">'.
							$folder.'</div>';
			  echo "<div class='selection'></div>";
				echo "</div></a></div>";
			}
		}
	}
  if($divided == 1) echo "</div>";
	return $counter;
}

/*********************************************************************
*	Generates HTML to create thumbnails from
*	get_projects() function but divides
*   the content based on the folder structure.
*	this function will only go 2 folders deep
**********************************************************************/
function get_all_projects_divided($addr, $border, $title){
	$id = 0;
  $folders =  scandir($addr);

	if($border == 0) echo "<div class='row'>";
	foreach($folders as $folder){
		if(!($folder == "." || $folder == "..")){
			if($border == 1){
				echo '<div class="row card">';
				echo '<div class="card-content">';
			}
			if($title == 1) echo "<h4>".$folder."</h4>";
			$id = get_projects($addr."/".$folder, $id);
			if($border == 1) echo '</div></div>';
		}
	}

	if($border == 0) echo "<div>";
}

/*********************************************************************
*	Generates HTML for the Nav menu along with their links
**********************************************************************/
function get_pages(){
	$id = 0;
	if(is_dir('../contents')){
  	$folders =  scandir('../contents');
		foreach($folders as $folder){
			if(!($folder == "." || $folder == "..")){
				echo "<li><a href='./content.php?dir=../contents/".$folder."'>".$folder."</a></li>";
			}
		}
	}
	else{
  	$folders =  scandir('contents');
		foreach($folders as $folder){
			if(!($folder == "." || $folder == "..")){
				echo "<li><a href='./pages/content.php?dir=../contents/".$folder."'>".$folder."</a></li>";
			}
		}
	}

}

/*********************************************************************
*	Generates the HTML to create thumbnails
*	this function expects a folder structure
*	two folders deep and uses the 2nd depth
*	folders titles as the thumbnail titles.
**********************************************************************/
function get_all_projects(){

	$id = 0;
    $folders =  scandir("projects");
	echo '<div class="row">';
	foreach($folders as $folder){
		if(!($folder == "." || $folder == "..")){

			//echo '<div class="card-content">';
			$id = get_projects("projects/".$folder, $id);
			//echo '</div>';
		}
	}
	echo '</div>';
}

/*********************************************************************
*	Generates an image courasel using all the files in
* the provided directory
**********************************************************************/
function get_carousel($addr){
	  $folders =  scandir($addr);
		echo '<div class="carousel carousel-slider" data-indicators="true">';
		$counter = 0;
		foreach($folders as $file){
			if(!($file == "." || $file == "..")){
				 if(preg_match("#img[0-9]+.(gif|png|jpg)#i", $file)){
					 $counter++;
					 echo "<a class='carousel-item' href='#".$counter."!'><img src='";
					 echo $addr."/".$file."'></a>";
				 }
			}
		}
		echo "</div>";
}

/*********************************************************************
*	Gets the content relavant to a single project
**********************************************************************/
function get_content($addr,$filename="readme.txt"){
	$location = htmlspecialchars($addr, ENT_QUOTES);
	if(file_exists($location."/".$filename)){
		$Parsedown = new ParsedownExtra();
		$file = fopen($location."/".$filename, "r");
		$string = "";
		while(! feof($file))	$string .= fgets($file);
		fclose($file);
		echo $Parsedown->text($string);
	}
}

/*********************************************************************
*	Gets the content relavant to an ithems coloumn-id
**********************************************************************/
function get_coloumn_content(){

	$id = 0;
    $folders =  scandir("projects");
	echo '<div class="row">';
	foreach($folders as $folder){
		if(!($folder == "." || $folder == "..")){

			//echo '<div class="card-content">';
			$id = get_projects("projects/".$folder, $id);
			//echo '</div>';
		}
	}
	echo '</div>';
}

?>
