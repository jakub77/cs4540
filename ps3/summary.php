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


$name = ""; $address = ""; $phone = "";
$name = $_SESSION['name'];
$address = $_SESSION['address'];
$phone = $_SESSION['phone'];
$position = $_SESSION['position'];
?>


<!DOCTYPE html>
<html>
<head>
<title>Resume Composer - Resume Look</title>
</head>
<body>

<h2>Resume</h2>
<form method="get">

<?php 
echo "<p>$name</p>";
echo "<p>$address  $phone</p>";
echo "<p>$position</p>";

echo "<p>Work experience</p>";

?>

<a href="contactInfo.php">Contact Info</a>
<a href="positionInfo.php">Position Sought</a>
<a href="employmentHistoryInfo.php">Employment History</a>
</form>
</body>
</html>


