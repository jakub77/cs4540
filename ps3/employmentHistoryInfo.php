<?php 
session_start();
if (!isset($_SESSION['startDates']))
	$_SESSION['startDates'] = Array();
if (!isset($_SESSION['stopDates']))
	$_SESSION['stopDates'] = Array();
if (!isset($_SESSION['descriptions']))
	$_SESSION['descriptions'] = Array();


$rowErrors = Array();
$rows;
$error = checkEmpoymentHistory ($startDates, $stopDates, $descriptions, $rowErrors, $rows);

if($error == 2){
	$startDates = $_SESSION['startDates'];
	$stopDates = $_SESSION['stopDates'];
	$descriptions = $_SESSION['descriptions'];
	$rows = count($startDates);
	for($i = 0; $i < $rows; $i++)
		$rowErrors[$i] = "";
}
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
<script>
function addRow(valStart, valEnd, valDesc, valError){
	var table = document.getElementById('table');
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var cell1 = row.insertCell(0);
	var element1 = document.createElement("input");
	element1.type = "text";
	element1.name = "startDate[]";
	element1.value = valStart;
	cell1.appendChild(element1);

	var cell2 = row.insertCell(1);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.name = "stopDate[]";
	element2.value = valEnd;
	cell2.appendChild(element2);

	var cell3 = row.insertCell(2);
	var textArea = document.createElement("textarea");
	textArea.setAttribute("name", "description[]");
	//textArea.style.height= "50px";
	//textArea.style.width = "250x";
	textArea.value = valDesc;
	cell3.appendChild(textArea);

	var cell4 = row.insertCell(3);
	var element4 = document.createElement("input");
	element4.type = "button";
	element4.value = "Remove";
	element4.addEventListener("click", deleteRow);
	cell4.appendChild(element4);

	var cell5 = row.insertCell(4);
	cell5.innerHTML = "<b id = 'error'>" + valError+ "</b>";
	
}

function deleteRow(src){
	var row = src.currentTarget.parentNode.parentNode;
	row.parentNode.removeChild(row);	
	
}
</script>

</head>
<?php 
echo "<body onload = '";
for($i = 0; $i < $rows; $i++){
	if($i > 0)
		echo ",";
	echo "addRow(\"$startDates[$i]\",\"$stopDates[$i]\",\"$descriptions[$i]\",\"$rowErrors[$i]\")";
}
echo "'>";
?>
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
function checkEmpoymentHistory (&$startDates, &$stopDates, &$descriptions, &$rowErrors, &$rows) {
	$rowErrors = Array();
	$error = 0;
	$rows = 0;
		
	if (isset($_REQUEST['startDate'])) {
		$startDates = $_GET['startDate'];
		$rows = count($startDates);
	}
	else
		return 2;

	if (isset($_REQUEST['stopDate'])) {
		$stopDates = $_GET['stopDate'];
	}
	if (isset($_REQUEST['description'])) {
		$descriptions = $_GET['description'];
	}
	
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
