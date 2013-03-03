<?php 
// Jakub Szpunar
// CS4540 Assignment 3
// February 2013

// Start the session.
session_start();
if (!isset($_SESSION['startDates']))
	$_SESSION['startDates'] = Array();
if (!isset($_SESSION['stopDates']))
	$_SESSION['stopDates'] = Array();
if (!isset($_SESSION['descriptions']))
	$_SESSION['descriptions'] = Array();


// Initialize local variables.
$rowErrors = Array();
$rows;

// Check to see if there were errors in filling out the form.
$error = checkEmpoymentHistory ($startDates, $stopDates, $descriptions, $rowErrors, $rows);

// If 2, it's a new form. Load data if applicable and make sure error messages are not null.
if($error == 2){
	$startDates = $_SESSION['startDates'];
	$stopDates = $_SESSION['stopDates'];
	$descriptions = $_SESSION['descriptions'];
	$rows = count($startDates);
	for($i = 0; $i < $rows; $i++)
		$rowErrors[$i] = "";
}
// Form was filled out at least partially, save data.
else{
	$_SESSION['startDates'] = $startDates;
	$_SESSION['stopDates'] = $stopDates;
	$_SESSION['descriptions'] = $descriptions;
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Resume Composer - Empoyment History</title>

<!-- DEFINE SCRIPTS USED TO ADD AND REMOVE ROWS -->

<script>
/* Add a row, set valStart to be the initial value of the start field, end, description, and error are similar. */
function addRow(valStart, valEnd, valDesc, valError){
	/* Get the table and row count */
	var table = document.getElementById('table');
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	/* Insert the start date field */
	var cell1 = row.insertCell(0);
	var element1 = document.createElement("input");
	element1.type = "text";
	element1.name = "startDate[]";
	element1.value = valStart;
	cell1.appendChild(element1);

	/* Insert the end date field */
	var cell2 = row.insertCell(1);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.name = "stopDate[]";
	element2.value = valEnd;
	cell2.appendChild(element2);

	/* Insert the description field */
	var cell3 = row.insertCell(2);
	var textArea = document.createElement("textarea");
	textArea.setAttribute("name", "description[]");
	textArea.value = valDesc;
	cell3.appendChild(textArea);

	/* Insert the remove row button */
	var cell4 = row.insertCell(3);
	var element4 = document.createElement("input");
	element4.type = "button";
	element4.value = "Remove";
	element4.addEventListener("click", deleteRow);
	cell4.appendChild(element4);

	/* Insert a field to display errors if they occur.*/
	var cell5 = row.insertCell(4);
	cell5.innerHTML = "<b id = 'error'>" + valError+ "</b>";
}

/* Function to delete a row when the button in the row is pressed. */
function deleteRow(src){
	var row = src.currentTarget.parentNode.parentNode;
	row.parentNode.removeChild(row);	
}
</script>
</head>
<?php 
// If there are rows (not a new page), set the browser to call addRow with the already populated fields.
if($rows > 0){
	echo "<body onload = '";
	for($i = 0; $i < $rows; $i++){
			if($i > 0)
			echo ",";
		echo "addRow(\"$startDates[$i]\",\"$stopDates[$i]\",\"$descriptions[$i]\",\"$rowErrors[$i]\")";
	}
	echo "'>";
}
// Otherwise, create the default one row of data.
else
	echo "<body onload = 'addRow(\"\", \"\", \"\", \"\")'>";
?>

<!-- NOW CREATE THE REST OF THE PAGE WITH LINKS AND DESCRIPTIONS OF THE TABLE COLUMNS -->
<h2>Prior Empoyment History</h2>
<form method='get'>
<table id = 'table'>
<tr>
<td>Starting Date</td>
<td>Ending Date</td>
<td>Description</td>
<td></td>
<td></td>
</tr>
</table>
<input type = 'button' value = 'Add row' onclick='addRow("", "", "", "")' />
<input type = 'submit' value = 'Submit' /><br>
<a href='contactInfo.php'>Contact Info</a>
<a href='positionInfo.php'>Position Sought</a>
<a href='summary.php'>Resume</a>
</form>
</body>
</html>

<?php 
// Function to check for errors in the submission.
// Return 1 = field error, 2 = fresh page, 0 = no error.
function checkEmpoymentHistory (&$startDates, &$stopDates, &$descriptions, &$rowErrors, &$rows) {
	// Initialize variables
	$rowErrors = Array();
	$error = 0;
	$rows = 0;
		
	// Check to see if it's a new page, and get the row count if it is not.
	// Also request the startDates.
	if (isset($_REQUEST['startDate'])) {
		$startDates = $_GET['startDate'];
		$rows = count($startDates);
	}
	else{
		return 2;
	}

	// Request stopDates
	if (isset($_REQUEST['stopDate'])) {
		$stopDates = $_GET['stopDate'];
	}
	
	// Request Descriptions.
	if (isset($_REQUEST['description'])) {
		$descriptions = $_GET['description'];
	}
	
	// Loop through all the rows of data making sure each field is filled out.
	// If a field is not filled out, inform user via setting an error message to be displayed in html.
	for($i = 0; $i < $rows; $i++){
		if(strlen($startDates[$i]) == 0){
			$rowErrors[$i] = "Empty Start Date";
			$error = 1;
		}
		elseif(strlen($stopDates[$i]) == 0){
			$rowErrors[$i] = "Empty Stop Date";
			$error = 1;
		}
		elseif(strlen($descriptions[$i]) == 0){
			$rowErrors[$i] = "Empty Description";
			$error = 1;
		}
		else {
			$rowErrors[$i] = "";
		}
	}
	return $error;
}
?>
