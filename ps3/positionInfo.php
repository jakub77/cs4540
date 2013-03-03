<?php 
// Jakub Szpunar
// CS4540 Assignment 3
// February 2013

// Start the session and set the variable if needed.
session_start();
if (!isset($_SESSION['position']))
	$_SESSION['position'] = "";

// Local variables.
$position; $positionError;

// Check if there are errors in form fill out.
$error = checkPositionInfo($position, $positionError);

// If 2, it's a fresh page, load data if there is some.
if($error == 2){
	$position = $_SESSION['position'];
}

// Otherwise save submission.
else{
	$_SESSION['position'] = $position;
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Resume Composer - Position Sought</title>
</head>
<body>

<h2>Position Sought</h2>
<form method="get">
<table>
 <tr>
  <td>Describe the type of job desired: </td>
 </tr>
 <tr>
 <?php 
 	// Output the requested position information field.
 	echo "<td><textarea name = 'position' rows = '20' cols= '50' >$position</textarea></td>";
 	echo "<td><b id = 'error'> $positionError</b></td>"
 ?>
 </tr>
 <tr>
  <td colspan="1"><input type = "submit" name = "submitContact" value = "Submit" /></td>
 </tr>
</table>
<a href="contactInfo.php">Contact Info</a>
<a href="employmentHistoryInfo.php">Empoyment History</a>
<a href="summary.php">Resume</a>
</form>
</body>
</html>

<?php 

// Check to see if there are errors in the submission.
// Return 1 = field error, 0 = no error, 2 = fresh page.
function checkPositionInfo(&$position, &$positionError) {
	// Initalize error state to no error.
	$positionError = "";
	$error = 0;
	
	// Check to see if it's a new page load.
	if (isset($_REQUEST['position'])) {
		$position = $_GET['position'];
		
		// See if the field is filled out.
		if(strlen($position) == 0){
			$error = 1;
			$positionError = "Please describe your requested position.";
		}
	}
	else
		return 2;

	return $error;
}
?>
