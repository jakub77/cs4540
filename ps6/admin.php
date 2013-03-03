<?php
// Jakub Szpunar
// CS4540 PS5

// Get the utilities
require('application/utilities.php');
require('application/db.php');

// Start/resume session
$isSubmission = resumeSession();

if(validateRole(0) == 1)
{
	forceReferer("admin.php");
	header("Location: login.php");
	exit();
}

if(validateRole(1) == 1)
{
	header("Location: badRoll.php");
	exit();
}

$userNames = array();
$realNames = array();
$roles = array();

listUsers($userNames, $realNames, $roles);

for($i = 0; $i < count($userNames); $i++)
{
	if(isset($_REQUEST["swap$i"]))
	{
		$role = $roles[$i];
		if($role == 2)
			$role = 1;
		else
			$role = 2;
		modifyUser($userNames[$i], $role);
		if($_SESSION['userName'] == $userNames[$i])
		{

			header("Location: logout.php");
			exit();
		}
		
		
		$userNames = array();
		$realNames = array();
		$roles = array();
		listUsers($userNames, $realNames, $roles);
		break;
	}
	if(isset($_REQUEST["delete$i"]))
	{
		deleteUser($userNames[$i]);
		if($_SESSION['userName'] == $userNames[$i])
		{
			header("Location: logout.php");
			exit();
		}
		$userNames = array();
		$realNames = array();
		$roles = array();
		listUsers($userNames, $realNames, $roles);
		break;
	}
}

require('views/admin.php');


?>