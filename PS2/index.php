<!--
Jakub Szpunar
CS4540 Web Software Architecture Spring 2013
PS2
January 2013
-->


<?php

// Set up default values for the form. Also set the locaiton of the images.
$selectedCaptions = array("","","","");
$selectedColors = array("","","","");
$selectedImages = array("", "", "", "");
$captionErrors = array("", "", "", "");
$colorErrors = array("", "", "", "");
$imageErrors = array("", "", "", "");
$catImage = "images/cat.jpg";
$dogImage = "images/dog.jpg";
$frogImage = "images/frog.jpg";
$horseImage = "images/horse.jpg";

// Check to see if the form has any errors.
$hasError = checkErrors($selectedCaptions, $captionErrors, $colorErrors, $imageErrors);

// In this case, the page is fresh, no errors / stuff to remember.
if($hasError == -1) {
	require("page.php");
} 
// In this case, there is an error. Repopulate the page and show the errors.
elseif ($hasError == 1) {
	repopulateForm($selectedCaptions, $selectedColors, $selectedImages);
	require("page.php");
}
// In this case, submit successful, show the second page.
else {
	require("page2.php");
}

// Set the page up to be filled out with input from the http get.
function repopulateForm(&$selectedCaptions, &$selectedColors, &$selectedImages) {
	// Loop through the four quadrents setting up defaults.
	for($i=0; $i<4;$i++){
		if(isset($_REQUEST['caption' . $i]))
			$selectedCaptions[$i] = $_GET["caption" . $i];
		if(isset($_REQUEST['color' . $i]))
			$selectedColors[$i] = $_GET["color" . $i];
		if(isset($_REQUEST['group' . $i]))
			$selectedImages[$i] = $_GET["group" . $i];
	}	
}

// Check the page for errors. When errors are found, fill in the error arrays with them.
function checkErrors (&$selectedCaptions, &$captionErrors, &$colorErrors, &$imageErrors) {
	// Initially no error was found.
	$error = 0;
	$caption = "";
	for($i = 0; $i < 4; $i++){
		// Check to see if there is a caption field in the http get.
		// If there is, get it, if there is not, that means this is a fresh page.
		if(isset($_REQUEST['caption' . $i]))
			$caption = $_GET["caption" . $i];
		else
			return -1;
		
		// Check to see if the caption is too short/long.
		if(strlen(trim($caption)) == 0) {
			$error = 1;
			$captionErrors[$i] = "Enter a Caption!";
		}
		elseif(strlen(trim($caption)) > 20){
			$error = 1;
			$captionErrors[$i] = "Caption is more than 20 characters!";
		}

		// Check to see if a color has been selected.
		if(!isset($_REQUEST["color$i"]))
		{
			$error = 1;
			$colorErrors[$i] = "Select a color!";
		}
		elseif(strlen($_GET["color$i"]) == 0){
			$error = 1;
			$colorErrors[$i] = "Select a color!";
		}
		
		// Check to see if a radio button has been selected.
		if(!isset($_REQUEST["group$i"]))
		{
			$error = 1;
			$imageErrors[$i] = "Select and Image!";
		}
	}	
	// Return whether there was an error.
	return $error;
}



?>