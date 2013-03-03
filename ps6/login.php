<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');
require('application/db.php');

// Start/resume session
$isSubmission = resumeSession();
$error = "";

setReferer("login.php");

// If this was a submission, try to register.
if ($isSubmission)
{
	if($_REQUEST['save'] == 'Cancel')
	{
		header("Location: " . useReferer());
		exit();	
	}
	
	$_SESSION['regUserName'] = getParam('userName', '');
	$_SESSION['regPass1'] = getParam('password1', '');
	
	if(signIn(getParam('userName', ''), getParam('password1', '')) == 1)
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