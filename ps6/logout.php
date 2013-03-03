<?php
// Jakub Szpunar
// CS4540 PS5
// Get the utilities
require('application/utilities.php');

// Start/resume session
resumeSession();

$_SESSION['userID'] = '';
$_SESSION['userName'] = '';
$_SESSION['role'] = 0;
$_SESSION['realName'] = '';

header("Location: contact.php");
exit();
?>
