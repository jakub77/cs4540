<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');

// Start/resume session
$isSubmission = resumeSession();

// Set the referer for the okay button to return to.
setReferer("badRoll.php");

// If this was a submission, return them to the referer.
if ($isSubmission)
{
	header("Location: " . useReferer());
	exit();
}
// Output the HTML
require("views/badRoll.php");

?>
