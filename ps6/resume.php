<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');
//require('applicaiton/db.php');
require("application/db.php");

// Start/resume session
resumeSession();

$name = getParam('name', '');
$login = getParam('login', '');
$error = 0;

// If name is not set, use session variables instead of DB.
if(strlen($name) == 0)
{
	$beg = $_SESSION['beg'];
	$end = $_SESSION['end'];
	$job = $_SESSION['job'];

	$contactName = $_SESSION['name'];
	$address = $_SESSION['address'];
	$phone = $_SESSION['phone'];
	$position = $_SESSION['position'];
}
else
{
	// If login is not set, use session login.
	if(strlen($login) == 0)
	{
		$login = $_SESSION['userName'];
	}
	// Get the data from the DB.
	$contactName;
	$address;
	$phone;
	$position;
	$beg=array();
	$end=array();
	$job=array();
	if(getResume($name, $login, $contactName, $address, $phone, $position, $beg, $end, $job) == 0)
		$error = 1;
}

// Output the HTML
if($error)
	require("application/errorLoad.php");
else
	require("views/resume.php");
?>
