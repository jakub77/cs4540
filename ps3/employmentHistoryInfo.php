<?php 
session_start();
if (!isset($_SESSION['startDates']))
	$_SESSION['startDates'] = Array();
if (!isset($_SESSION['stopDates']))
	$_SESSION['stopDates'] = Array();
if (!isset($_SESSION['descriptions']))
	$_SESSION['descriptions'] = Array();

$startDates =& $_SESSION['startDates'];
$stopDates =& $_SESSION['stopDates'];
$descriptions =& $_SESSION['descriptions'];
$rowErrors = Array();

checkEmpoymentHistory ($startDates, $stopDates, $descriptions, $rowErrors);

?>

<!DOCTYPE html>
<html>
<head>
<title>Resume Composer - Empoyment History</title>
<script>
function addRow(tableID){
	var table = document.getElementById('table');
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var cell1 = row.insertCell(0);
	var element1 = document.createElement("input");
	element1.type = "text";
	element1.name = "startDate";
	cell1.appendChild(element1);

	var cell2 = row.insertCell(1);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.name = "stopDate";
	cell2.appendChild(element2);

	var cell3 = row.insertCell(2);
	var textArea = document.createElement("textarea");
	textArea.setAttribute("name", "description");
	textArea.style.height= "50px";
	textArea.style.width = "250x";
	cell3.appendChild(textArea);

	var cell4 = row.insertCell(3);
	var element4 = document.createElement("input");
	element4.type = "button";
	element4.value = "Remove";
	element4.addEventListener("click", deleteRow);
	cell4.appendChild(element4);
}

function deleteRow(src){
	var row = src.currentTarget.parentNode.parentNode;
	row.parentNode.removeChild(row);	
}
</script>

</head>
<body onload = "addRow()">
<h2>Prior Empoyment History</h2>
<form method="get">
<table id = "table">
<tr>
 <td>Starting Date</td>
 <td>Ending Date</td>
 <td>Description</td>
 <td></td>
</tr>
</table>
<input type = "button" value = "Add row" onclick="addRow()" />
<input type = "submit" value = "Submit" /><br>
<a href="contactInfo.php">Contact Info</a>
<a href="positionInfo.php">Position Sought</a>
<a href="summary.php">Resume</a>
</form>
</body>
</html>

<?php 
function checkEmpoymentHistory (&$startDates, &$stopDates, &$descriptions, &$rowErrors) {
	$rowErrors = Array();
	$error = 0;
	
	$startDates =& $_SESSION['startDates'];
	$stopDates =& $_SESSION['stopDates'];
	$descriptions =& $_SESSION['descriptions'];
	
	
	if (isset($_REQUEST['startDates[]'])) {
		$name = $_GET['startDates[]'];
		echo "count of startDates: " . count($name);
		
	}
	else
		return 2;

	if (isset($_REQUEST['stopDates[]'])) {
		$address = $_GET['stopDates[]'];

	}
	if (isset($_REQUEST['descriptions[]'])) {
		$phone = $_GET['descriptions[]'];

	}

	return $error;
}


?>
