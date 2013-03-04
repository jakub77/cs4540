<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');
require('application/db.php');
require('application/auth.php');

// Redirect to https
redirectToHTTPS();

// Start/resume session
$isSubmission = resumeSession();
$error = "";

// Set the referer.
setReferer("register.php");

// If this was a submission, try to register.
if ($isSubmission)
{
	// If they are canceling, return them to the referer.
	if($_REQUEST['save'] == 'Cancel')
	{
		header("Location: " . useReferer());
		exit();
	}
	
	// Otherwise, save their given parameters.
	$_SESSION['regUserName'] = getParam('userName', '');
	$_SESSION['regRealName'] = getParam('realName', '');
	$_SESSION['regPass1'] = getParam('password1', '');
	$_SESSION['regPass2'] = getParam('password2', '');

	// Validate parameters in php too
	if(strlen(getParam('userName', '')) == 0)
	{
		$error = "Username is too short";
	}
	elseif(strlen(getParam('realName', '')) == 0)
	{
		$error = "Real Name is too short";
	}
	elseif(strlen(getParam('password1', '')) < 8)
	{
		$error = "Password must be 8 or more characters.";
	}
	elseif(getParam('password1', '') != getParam('password2', ''))
	{
		$error = "Passwords don't match.";
	}
	else
	{
		// If the username is not free, don't let them use it.
		if(usernameFree(getParam('userName', '')) == 0)
		{
			$error = "That username is already taken.";
		}
		else
		{
			// Try to sign them up.
			if(signUp(getParam('userName', ''), computeHash(getParam('password1', ''), $_SESSION['salt']), getParam('realName', '')) == 1)
			{
				// If sucessful, clear temp session variables and redirect them to the referer.
				$_SESSION['regUserName'] = "";
				$_SESSION['regRealName'] = "";
				$_SESSION['regPass1'] = "";
				$_SESSION['regPass2'] = "";
				header("Location: " . useReferer());
				exit();
			}
		}
	}
}

// Output the HTML
require("views/register.php");


?>