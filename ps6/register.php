<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');
require('application/db.php');

// Start/resume session
$isSubmission = resumeSession();
$error = "";

setReferer("register.php");

// If this was a submission, try to register.
if ($isSubmission)
{
	if($_REQUEST['save'] == 'Cancel')
	{
		header("Location: " . useReferer());
		exit();
	}

	$_SESSION['regUserName'] = getParam('userName', '');
	$_SESSION['regRealName'] = getParam('realName', '');
	$_SESSION['regPass1'] = getParam('password1', '');
	$_SESSION['regPass2'] = getParam('password2', '');

	//$_SESSION['position'] = getParam('position', '');
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
		if(usernameFree(getParam('userName', '')) == 0)
		{
			$error = "That username is already taken.";
		}
		else
		{
			if(signUp(getParam('userName', ''), getParam('password1', ''), getParam('realName', '')) == 1)
			{
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