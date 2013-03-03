<?php
// Jakub Szpunar
// CS4540 PS5
// Get the utilities
require('application/utilities.php');

// Start/resume session
$isSubmission = resumeSession();

setReferer("badRoll.php");

// If this was a submission, try to register.
if ($isSubmission)
{
	header("Location: " . useReferer());
	exit();
}
// Output the HTML
require("views/badRoll.php");

?>
