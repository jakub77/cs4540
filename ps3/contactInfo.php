<?php 
// Jakub Szpunar
// CS4540 Assignment 3
// February 2013

// Start the session and set the variable if needed.
session_start();
if (!isset($_SESSION['name']))
	$_SESSION['name'] = "";
if (!isset($_SESSION['address']))
	$_SESSION['address'] = "";
if (!isset($_SESSION['phone']))
	$_SESSION['phone'] = "";

// Set up local variables.
$name; $address; $phone; $nameError; $phoneError; $addressError;

// Check the error status of the page.
$error = checkContactInfo($name, $address, $phone, $nameError, $addressError, $phoneError);

// If it is a fresh page, see if there is session state to load.
if($error == 2){
	$name = $_SESSION['name'];
	$address = $_SESSION['address'];
	$phone = $_SESSION['phone'];
}
// Otherwise, save the filled out page, even if partially filled out.
else{
	$_SESSION['name'] = $name;
	$_SESSION['address'] = $address;
	$_SESSION['phone'] = $phone;
}

?>

<!-- Now create the HTML for the page. -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Resume Composer - Contact Information</title>
</head>
<body>
<h2>Contact Information</h2>
<form method="get">
<table>
 <tr>
  <td>Name: </td>
  <?php 
  // Echo out the name field and an error if needed.
  echo "<td><input type = 'text' name = 'name' value = '$name' /></td>";
  echo "<td><b id = 'error'> $nameError</b></td>"; ?>
 </tr>
 <tr>
  <td>Address: </td>
  <?php 
  // Echo out the address field and error.
  echo "<td><input type = 'text' name = 'address' value = '$address' /></td>";
  echo "<td><b id = 'error'> $addressError</b></td>"; ?>
 </tr>
 <tr>
  <td>Phone #: </td>
  <?php
  // Echo out the phone field and error.
  echo "<td><input type = 'text' name = 'phone' value = '$phone' /></td>";
  echo "<td><b id = 'error'> $phoneError</b>$phoneError</td>"; ?>
 </tr>
 <tr>
  <td colspan="2"><input type = "submit" name = "submitContact" value = "Submit" /></td>
 </tr>
</table>

<!-- Links to further pages -->
<a href="positionInfo.php">Position Sought</a>
<a href="employmentHistoryInfo.php">Employment History</a>
<a href="summary.php">Resume</a>
</form>
</body>
</html>

<?php 
// Function to check whether there are errors in the submission. If there are, the error variables are populated.
// Returns 0 = no error. 1 = field error. 2 = first load of page.
function checkContactInfo (&$name, &$address, &$phone, &$nameError, &$addressError, &$phoneError) {	
	// Initialize to no errors.
	$nameError = "";
	$addressError = "";
	$phoneError = "";
	$error = 0;	
	
	// Ckec to see if there is a name variable in the get header. If there isn't it's a fresh page.
	if (isset($_REQUEST['name'])) {
		$name = $_GET['name'];
		// Error check name.
		if(strlen($name) == 0){
			$error = 1;
			$nameError = "Enter your name";
		}
	}
	else
		return 2;
	
	// Error check address.
	if (isset($_REQUEST['address'])) {
		$address = $_GET['address'];
		if(strlen($address) == 0){
			$error = 1;
			$addressError = "Enter your address";
		}
	}
	
	// Error check phone.
	if (isset($_REQUEST['phone'])) {
		$phone = $_GET['phone'];
		if(strlen($phone) == 0){
			$error = 1;
			$phoneError = "Enter your phone";
		}
	}	
	return $error;
}
?>
