<?php

//Jakub Szpunar
// CS4540 PS5

// Resumes a session; initializes session variables if necessary
// Reports whether this is a submission
function resumeSession () 
{
	session_start();
	initSession('beg', array(''));
	initSession('end', array(''));
	initSession('job', array(''));
	initSession('name', '');
	initSession('address', '');
	initSession('phone', '');
	initSession('position', '');
	initSession('resumeName', '');
	return isset($_REQUEST['save']);
}

// If $param is not a session variable, create it with $default as its value
function initSession ($param, $default)
{
	if (!isset($_SESSION[$param]))
	{
		$_SESSION[$param] = $default;
	}
}

// Echoes a session variable
function sticky ($param)
{
	echo $_SESSION[$param];
}

// If the current request is a save, echoes "class=error" if
// the named session variable is the empty string
function validate ($param)
{
	global $isSubmission;
	if ($isSubmission && strlen($_SESSION[$param]) == 0)
	{
		echo "class='error'";
	}
}

// Return the value of the parameter $param if it exists.
// Otherwise, return $default.
function getParam ($param, $default)
{
	return (isset($_REQUEST[$param])) ? $_REQUEST[$param] : $default;
}

// Returns 'true' if this was a submission and $string is empty, returns 'false' otherwise.
function check ($string)
{
	global $isSubmission;
	return ($isSubmission && strlen($string) == 0) ? 'true' : 'false';
}

?>
