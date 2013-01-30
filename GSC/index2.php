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

// Pick the image to be displayed
$cookieImage = createCookieImage($chosenCookie);

// Display the page
require('application/page2.php');


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
