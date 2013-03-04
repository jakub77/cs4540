<?php

//Jakub Szpunar
// CS4540 PS6

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
	initSession('salt', 'asdfasdf');
	initSession('phone', '');
	initSession('position', '');
	initSession('resumeName', '');
	initSession('userID', '');
	initSession('userName', '');
	initSession('role', 0);
	initSession('realName', '');
	initSession('regPass1','');
	initSession('regPass2','');
	initSession('regRealName','');
	initSession('regUserName','');
	initSession('referer', '');
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

/**
 * Store the referer. Doesn't store if currentPage is the same as the referer.
 * @param $currentPage
 */
function setReferer($currentPage)
{
	if(!isset($_SERVER['HTTP_REFERER']))
	{
		return;
	}
	if(strpos($_SERVER['HTTP_REFERER'], $currentPage) === false)
	{
		$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
	}
	return;
}

/**
 * Force sets a referer to $page
 * @param unknown $page
 */
function forceReferer($page)
{
	$_SESSION['referer'] = $page;
}

/**
 * Use a referer. Returns the referer and clears the referer from the session.
 * @return Ambigous <string, unknown>
 */
function useReferer()
{
	$res = $_SESSION['referer'];
	$_SESSION['referer'] = '';
	if(strlen($res) == 0)
		$res = 'contact.php';
	return $res;
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
	return (isset($_REQUEST[$param])) ? htmlspecialchars($_REQUEST[$param]) : $default;
}

function getParamA ($param, $default)
{
	return (isset($_REQUEST[$param])) ? $_REQUEST[$param] : $default;
}

// Returns 'true' if this was a submission and $string is empty, returns 'false' otherwise.
function check ($string)
{
	global $isSubmission;
	return ($isSubmission && strlen($string) == 0) ? 'true' : 'false';
}

/**
 * Validate the user has the right role.
 * @param Desired role for the user to have $desiredRole
 * @return 1 on the right role, 0 otherwise.
 */
function validateRole($desiredRole)
{
	if($_SESSION['role'] != $desiredRole)
		return 0;
	return 1;
}

?>
