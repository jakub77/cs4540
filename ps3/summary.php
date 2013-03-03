<?php 
// Jakub Szpunar
// CS4540 Assignment 3
// February 2013

// Start the session and initialize session variables if needed.
session_start();
if (!isset($_SESSION['name']))
	$_SESSION['name'] = "";
if (!isset($_SESSION['address']))
	$_SESSION['address'] = "";
if (!isset($_SESSION['phone']))
	$_SESSION['phone'] = "";
if (!isset($_SESSION['position']))
	$_SESSION['position'] = "";
if (!isset($_SESSION['startDates']))
	$_SESSION['startDates'] = Array();
if (!isset($_SESSION['stopDates']))
	$_SESSION['stopDates'] = Array();
if (!isset($_SESSION['descriptions']))
	$_SESSION['descriptions'] = Array();

// Set up local variables to store data from the session.
//$name = ""; $address = ""; $phone = "";
$name = $_SESSION['name'];
$address = $_SESSION['address'];
$phone = $_SESSION['phone'];
$position = $_SESSION['position'];
$startDates = $_SESSION['startDates'];
$stopDates = $_SESSION['stopDates'];
$descriptions = $_SESSION['descriptions'];
?>

<!--  CREATE THE HTML FOR THE PAGE -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Resume Composer - Resume Look</title>
</head>
<body>

<form method="get">
<table id = 'summaryTable'>
<?php 

// Display information as a table. Use a new row for each bit of information.
echo "<tr><td>$name</td></tr>";
echo "<tr><td>$phone</td></tr>";
echo "<tr><td>$address</td></tr>";
echo "<tr><td><h3>Position Sought</h3></td></tr>";
echo "<tr><td>$position</td></tr>";
echo "<tr><td><h3>Work experience</h3></td></tr>";
for($i = 0; $i < count($startDates); $i++){
	echo "<tr><td>$startDates[$i] - $stopDates[$i]: $descriptions[$i]</td></tr>";
}
?>
</table>
</form>
</body>
</html>


