<?php
// Jakub Szpunar
// CS4540 PS5

// Get the utilities
require('application/utilities.php');

// Start/resume session
$isSubmission = resumeSession();

// If this was a submission, save parameters to session
if ($isSubmission) 
{	
	$_SESSION['name'] = getParam('name', '');
    $_SESSION['address'] = getParam('address', '');
    $_SESSION['phone'] = getParam('phone', '');
}

// Output the HTML
require("views/contact.php");

?>
