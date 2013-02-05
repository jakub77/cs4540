<?php 

session_start();
if (!isset($_SESSION['name']))
	$_SESSION['name'] = "";
if (!isset($_SESSION['address']))
	$_SESSION['address'] = "";
if (!isset($_SESSION['phone']))
	$_SESSION['phone'] = "";

$name; $address; $phone; $nameError; $phoneError; $addressError;
$error = checkContactInfo($name, $address, $phone, $nameError, $addressError, $phoneError);
if($error == 0){
	$_SESSION['name'] = $name;
	$_SESSION['address'] = $address;
	$_SESSION['phone'] = $phone;
}
if($error == 2){
	$name = $_SESSION['name'];
	$address = $_SESSION['address'];
	$phone = $_SESSION['phone'];
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Resume Composer - Contact Information</title>
</head>
<body>
<h2>Contact Information</h2>
<form method="get">
<table>
 <tr>
  <td>Name: </td>
  <?php 
  //$name = $_SESSION['name'];
  echo "<td><input type = 'text' name = 'name' value = '$name' /></td>";
  echo "<td>$nameError</td>"; ?>
 </tr>
 <tr>
  <td>Address: </td>
  <?php 
  //$address = $_SESSION['address'];
  echo "<td><input type = 'text' name = 'address' value = '$address' /></td>";
  echo "<td>$addressError</td>"; ?>
 </tr>
 <tr>
  <td>Phone #: </td>
  <?php
  //$phone = $_SESSION['phone'];
  echo "<td><input type = 'text' name = 'phone' value = '$phone' /></td>";
  echo "<td>$phoneError</td>"; ?>
 </tr>
 <tr>
  <td colspan="2"><input type = "submit" name = "submitContact" value = "Submit" /></td>
 </tr>
</table>
<a href="positionInfo.php">Position Sought</a>
<a href="employmentHistoryInfo.php">Employment History</a>
<a href="summary.php">Resume</a>
</form>
</body>
</html>

<?php 

function checkContactInfo (&$name, &$address, &$phone, &$nameError, &$addressError, &$phoneError) {	
	$nameError = "";
	$addressError = "";
	$phoneError = "";
	$error = 0;	
	if (isset($_REQUEST['name'])) {
		$name = $_GET['name'];
		if(strlen($name) == 0){
			$error = true;
			$nameError = "Enter your name";
		}
	}
	else
		return 2;
	
	if (isset($_REQUEST['address'])) {
		$address = $_GET['address'];
		if(strlen($address) == 0){
			$error = true;
			$addressError = "Enter your address";
		}
	}
	if (isset($_REQUEST['phone'])) {
		$phone = $_GET['phone'];
		if(strlen($phone) == 0){
			$error = true;
			$phoneError = "Enter your phone";
		}
	}
		
	return $error;
}

?>
