<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');

// Start/resume session
resumeSession();

// Update the session variables to be empty, no user logged in.
$_SESSION['userID'] = '';
$_SESSION['userName'] = '';
$_SESSION['role'] = 0;
$_SESSION['realName'] = '';

// Send to user to the contact page
header("Location: contact.php");
exit();
?>
