<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');

// Start/resume session
$isSubmission = resumeSession();

// If this was a submission, save parameters to session
if ($isSubmission) 
{	
	$_SESSION['position'] = getParam('position', '');
}

// Output the HTML
require("views/position.php");

?>
