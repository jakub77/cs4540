<?php

echo "Hello World!";

$selectedCaptions = array("","","","");
$selectedColors = array("","","","");
$selectedImages = array("", "", "", "");

//checkErrors($selectedCaptions);
repopulateForm($selectedCaptions,$selectedColors,$selectedImages);

require("page.php");

function repopulateForm(&$selectedCaptions, &$selectedColors, &$selectedImages){
	for($i=0; $i<4;$i++){
		if(isset($_REQUEST['caption' . $i]))
			$selectedCaptions[$i] = $_GET["caption" . $i];
		if(isset($_REQUEST['color' . $i]))
			$selectedColors[$i] = $_GET["color" . $i];
		if(isset($_REQUEST['group' . $i]))
			$selectedImages[$i] = $_GET["group" . $i];
	}	
}

function checkErrors (&$selectedCaptions) {
	$error = false;
	$caption = "";
	for($i=0; $i<4;$i++){
		if(isset($_REQUEST['caption' . $i]))
			$caption = $_GET["caption" . $i];
	}
		
	
	return $error;
	
	
	/*function checkQuantity (&$display, &$order, &$message, $isSubmission) {
	
	// Set default values
	$display = '';
	$order = 0;
	$message = '';
	
	if (isset($_REQUEST['quantity'])) {
		$display = $_REQUEST['quantity'];
		if ($isSubmission) {
			$quantity = filter_var(trim($display), FILTER_VALIDATE_INT);
			if (is_bool($quantity)) {
				$message = 'Enter a count';
			}
			else if ($quantity <= 0) {
				$message = 'Enter a positive count';
			}
			else {
				$message = 'Thank you!';
				$order = $quantity;
				$display = '';
			}
		}
	}
}*/
}



?>