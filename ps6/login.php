<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');
require('application/db.php');
require('application/auth.php');

// Redirect to https.
redirectToHTTPS();

// Start/resume session
$isSubmission = resumeSession();
$error = "";

// Set the referer.
setReferer("login.php");

// If this was a submission, try to register.
if ($isSubmission)
{
	// If they hit cancel, return to refer.
	if($_REQUEST['save'] == 'Cancel')
	{
		$_SESSION['regUserName'] = "";
		$_SESSION['regPass1'] = "";
		header("Location: " . useReferer());
		exit();	
	}
	
	// Otherwise, get their submission and attempt to login.	
	$_SESSION['regUserName'] = getParam('userName', '');
	$_SESSION['regPass1'] = getParam('password1', '');
	if(signIn(getParam('userName', ''), computeHash(getParam('password1', ''), $_SESSION['salt'])) == 1)
	{
		$_SESSION['regUserName'] = "";
		$_SESSION['regPass1'] = "";
		header("Location: " . useReferer());
		exit();
	}
	
	$error = "UserName/Password could not be validated";
}

// Output the HTML
require("views/login.php");


?>