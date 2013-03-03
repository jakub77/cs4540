<?php
// Jakub Szpunar
// CS4540 PS5
// Get the utilities
require('application/utilities.php');
//require('applicaiton/db.php');
require("application/db.php");

// Start/resume session
resumeSession();

$name = getParam('name', '');
$login = getParam('login', '');
$error = 0;

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
	if(strlen($login) == 0)
	{
		$login = $_SESSION['userName'];
	}
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
