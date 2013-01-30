<?php 

// Contains information about cookies
require('application/cookies.php');

// Figure out which cookie should be displayed in the form.
if (isset($_REQUEST['variety'])) {
	$chosenCookie = $_REQUEST['variety'];
}
else {
	$chosenCookie = $defaultCookie;
}

// Initialize the variable that generates the cookie options
$cookieOptions = createCookieOptions($cookieTypes, $chosenCookie);

// Figure out what message related to quantity should be displayed
checkQuantity($quantityDisplay, $quantityOrder, $quantityMessage);

// Pick the image to be displayed
$cookieImage = createCookieImage($chosenCookie);

// Include the page
require("application/page3.php");

// Figures out what to display in the quantity field, how many boxes
// have been ordered, and what message to display on the form.
function checkQuantity (&$display, &$order, &$message) {
	
	// Set default values
	$display = '';
	$order = 0;
	$message = '';
	
	// Customize the values
	if (isset($_REQUEST['quantity'])) {
		$display = $_REQUEST['quantity'];
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

// Returns a sequence of OPTION tags that can be used to display
// the cookie choices in a pulldown menu. $cookieTypes is an array
// of key/value pairs; $selected is the key of the cookie that should
// be the selected option.
function createCookieOptions ($cookieTypes, $selected) {
	$result = '';
	foreach ($cookieTypes as $key => $name) {
		$selection = ($selected == $key) ? "selected='selected'" : "";
		$result = $result . "<option value='$key' $selection>$name</option>\n";
	}
	return $result;
}

// Returns the URL of the cookie image to be displayed.
function createCookieImage ($defaultCookie) {
	return "cookies/$defaultCookie.jpg";
}

?>
