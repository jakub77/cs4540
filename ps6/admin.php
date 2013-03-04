<?php
// Jakub Szpunar
// CS4540 PS6

// Get the utilities
require('application/utilities.php');
require('application/db.php');
require('application/auth.php');

// Redirect to HTTPS.
redirectToHTTPS();

// Start/resume session
$isSubmission = resumeSession();

// If they are logged out, redirect to login.
if(validateRole(0) == 1)
{
	forceReferer("admin.php");
	header("Location: login.php");
	exit();
}

// If they are users, tell them their role is bad.
if(validateRole(1) == 1)
{
	header("Location: badRoll.php");
	exit();
}

// Get the users from the DB.
$userNames = array();
$realNames = array();
$roles = array();
listUsers($userNames, $realNames, $roles);

// Now loop through on the page seeing if someone pressed a button.
for($i = 0; $i < count($userNames); $i++)
{
	// Swap $ith person.
	if(isset($_REQUEST["swap$i"]))
	{
		// Generate the new role.
		$role = $roles[$i];
		if($role == 2)
			$role = 1;
		else
			$role = 2;
		// Modify the role.
		modifyUser($userNames[$i], $role);
		// If this was the currently logged in user, log them out.
		if($_SESSION['userName'] == $userNames[$i])
		{

			header("Location: logout.php");
			exit();
		}
		// Otherwise, display the new users.
		$userNames = array();
		$realNames = array();
		$roles = array();
		listUsers($userNames, $realNames, $roles);
		break;
	}
	// If they pressed a delete button
	if(isset($_REQUEST["delete$i"]))
	{
		// Delete the user
		deleteUser($userNames[$i]);
		// If this was the current user, log them out.
		if($_SESSION['userName'] == $userNames[$i])
		{
			header("Location: logout.php");
			exit();
		}
		// Otherwise, display the new users.
		$userNames = array();
		$realNames = array();
		$roles = array();
		listUsers($userNames, $realNames, $roles);
		break;
	}
}

require('views/admin.php');


?>