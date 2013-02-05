<?php 

session_start();
if (!isset($_SESSION['position']))
	$_SESSION['position'] = "";

$position; $positionError;
$error = checkPositionInfo($position, $positionError);
if($error == 0){
	$_SESSION['position'] = $position;
}
if($error == 2){
	$position = $_SESSION['position'];
}

?>

<!DOCTYPE html>
<html>
<head>
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
 	echo "<td><textarea name = 'position' rows = '10' >$position</textarea></td>";
 	echo "<td>$positionError</td>"
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
function checkPositionInfo(&$position, &$positionError) {
	$positionError = "";
	$error = 0;
	if (isset($_REQUEST['position'])) {
		$position = $_GET['position'];
		
		if(strlen($position) == 0){
			$error = true;
			$positionError = "Please describe your requested position.";
		}
	}
	else
		return 2;

	return $error;
}
?>
