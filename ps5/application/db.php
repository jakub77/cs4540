<?php
//Jakub Szpunar
// CS4540 PS5

// Opens and returns a DB connection
function openDBConnection () {
	$DBH = new PDO("mysql:host=atr.eng.utah.edu;dbname=ps4_szpunar",
			'szpunar_sw', '00578522');
	$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $DBH;
}

// Check to see if a resume exists.
function resumeExists($resumeName)
{
	try{
		$ID = -1;
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select ID from Resumes where Name=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->execute();
		if ($row = $stmt->fetch())
			$ID = $row['ID'];
		if($ID == -1)
			return 0;
		return 1;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

// Get a resume and store it in the variables referenced.
function getResume($resumeName, &$name, &$address, &$phone, &$position, &$beg, &$end, &$job){
	try{
		$ID = -1;
		$DBH = openDBConnection();
		// First get from the Resume table.
		$stmt = $DBH->prepare("select ID, ContactName, ContactAddress, ContactPhone, Position from Resumes where Name=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$ID = $row['ID'];
			$name = $row['ContactName'];
			$address = $row['ContactAddress'];
			$phone = $row['ContactPhone'];
			$position = $row['Position'];
		}

		// If we got something out of the resume table, now get the pastEmpoyInfo.
		if($ID != -1)
		{
			$stmt = $DBH->prepare("select StartDate, StopDate, PastEmpoyDesc from PastEmpoyInfo where ResumeID=?");
			$stmt->bindValue(1, $ID);
			$stmt->execute();

			while($row = $stmt->fetch())
			{
				array_push($beg, $row['StartDate']);
				array_push($end, $row['StopDate']);
				array_push($job, $row['PastEmpoyDesc']);
			}
			return 1;
		}
		return 0;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

// Load a resume, same as getResume, except it loads into session varaibles.
function loadResume($resumeName){
	try{
		$ID = -1;
		$DBH = openDBConnection();
		// First get from Resumes table.
		$stmt = $DBH->prepare("select ID, ContactName, ContactAddress, ContactPhone, Position from Resumes where Name=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$ID = $row['ID'];
			$_SESSION['name'] = $row['ContactName'];
			$_SESSION['address'] = $row['ContactAddress'];
			$_SESSION['phone'] = $row['ContactPhone'];
			$_SESSION['position'] = $row['Position'];
		}

		// Now get from Past Employ info.
		if($ID != -1)
		{
			$stmt = $DBH->prepare("select StartDate, StopDate, PastEmpoyDesc from PastEmpoyInfo where ResumeID=?");
			$stmt->bindValue(1, $ID);
			$stmt->execute();

			$beg = array();
			$end = array();
			$job = array();

			while($row = $stmt->fetch())
			{
				array_push($beg, $row['StartDate']);
				array_push($end, $row['StopDate']);
				array_push($job, $row['PastEmpoyDesc']);
			}

			$_SESSION['beg'] = $beg;
			$_SESSION['end'] = $end;
			$_SESSION['job'] = $job;
			return 1;
		}
		return 0;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

// Store a resume.
function storeResume($resumeName)
{
	try{
		$ID = -1;
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select ID from Resumes where Name=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$ID = $row['ID'];
		}

		// If the ID already existed, update it.
		if($ID != -1)
		{
			$stmt = $DBH->prepare("update Resumes set ContactName=?, ContactAddress=?, ContactPhone=?,Position=? where ID=?");
			$stmt->bindValue(1, $_SESSION['name']);
			$stmt->bindValue(2, $_SESSION['address']);
			$stmt->bindValue(3, $_SESSION['phone']);
			$stmt->bindValue(4, $_SESSION['position']);
			$stmt->bindValue(5, $ID);
			$stmt->execute();

			// Delete any past employ info.
			$stmt = $DBH->prepare("delete from PastEmpoyInfo where ResumeID=?");
			$stmt->bindValue(1, $ID);
			$stmt->execute();
		}
		// Otherwise, insert it into the table.
		else
		{
			$stmt = $DBH->prepare("insert into Resumes (Name, ContactName, ContactAddress, ContactPhone, Position)
					Values (?, ?, ?, ?, ?)");
			$stmt->bindValue(1, $_SESSION['resumeName']);
			$stmt->bindValue(2, $_SESSION['name']);
			$stmt->bindValue(3, $_SESSION['address']);
			$stmt->bindValue(4, $_SESSION['phone']);
			$stmt->bindValue(5, $_SESSION['position']);
			$stmt->execute();
			$ID = $DBH->lastInsertId();
		}

		// Insert new past empoy info.
		for($i = 0; $i < count($_SESSION['beg']); $i++)
		{
			$stmt = $DBH->prepare("insert into PastEmpoyInfo (ResumeID, StartDate, StopDate, PastEmpoyDesc)
					Values (?, ?, ?, ?)");
			$stmt->bindValue(1, $ID);
			$stmt->bindValue(2, $_SESSION['beg'][$i]);
			$stmt->bindValue(3, $_SESSION['end'][$i]);
			$stmt->bindValue(4, $_SESSION['job'][$i]);
			$stmt->execute();
		}
		if($ID != -1)
			return 1;
		return 0;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

// Delete a resume.
function deleteResume($resumeName)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("delete from Resumes where Name=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->execute();
		if($stmt->rowCount() == 0)
			return 0;
		return 1;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

// Logs and reports a database error
function reportDBError ($exception) {
	$file = fopen("application/log.txt", "a");
	fwrite($file, date(DATE_RSS));
	fwrite($file, "\n");
	fwrite($file, $exception->getMessage());
	fwrite($file, "\n");
	fwrite($file, "\n");
	fclose($file);
	require "application/error.php";
	exit();
}

?>