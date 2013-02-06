<?php 

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

$name = ""; $address = ""; $phone = "";
$name = $_SESSION['name'];
$address = $_SESSION['address'];
$phone = $_SESSION['phone'];
$position = $_SESSION['position'];
$startDates = $_SESSION['startDates'];
$stopDates = $_SESSION['stopDates'];
$descriptions = $_SESSION['descriptions'];
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Resume Composer - Resume Look</title>
</head>
<body>

<form method="get">

<?php 
echo "<p>$name</p>";
echo "<p>$address  $phone</p>";
echo "<p>$position</p>";

echo "<p>Work experience</p>";

for($i = 0; $i < count($startDates); $i++){
	echo "<p>$startDates[$i] - $stopDates[$i]: $descriptions[$i]</p>";
}

?>

<a href="contactInfo.php">Contact Info</a>
<a href="positionInfo.php">Position Sought</a>
<a href="employmentHistoryInfo.php">Employment History</a>
</form>
</body>
</html>


