<?php
//Jakub Szpunar
// CS4540 PS5

// Opens and returns a DB connection
function openDBConnection () {
	$DBH = new PDO("mysql:host=atr.eng.utah.edu;dbname=ps6_szpunar",
			'szpunar_sw', '00578522');
	$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $DBH;
}

/**
 * Delete a user.
 * @param username $username
 * @return 1 on success, 0 on failure.
 */
function deleteUser($username)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("delete from Users where UserName=?");
		$stmt->bindValue(1, $username);
		$stmt->execute();
		return 1;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

/**
 * Modify a user's role.
 * @param username $username
 * @param new role $role
 * @return 1 on success, 0 on failure.
 */
function modifyUser($username, $role)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("update Users set Role =? where UserName=?");
		$stmt->bindValue(1, $role);
		$stmt->bindValue(2, $username);
		$stmt->execute();
		return 1;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}	
}

/**
 * Lists all the users in the DB
 * @param Sets $userNames
 * @param Sets $realNames
 * @param Sets $roles
 * @return 1 on success, 0 on failure.
 */
function listUsers(&$userNames, &$realNames, &$roles)
{
	try{
		$found = 0;
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select UserName, RealName, Role from Users");
		$stmt->execute();
		while($row = $stmt->fetch())
		{
			array_push($userNames, $row['UserName']);
			array_push($realNames, $row['RealName']);
			array_push($roles, $row['Role']);
			$found = 1;
		}
		return $found;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

/**
 * Loads userID, realName, role into session variables if credentials are right.
 * @param Username $username
 * @param Password $password
 * @return 1 if success, 0 if invalid
 */
function signIn($username, $password)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select ID, RealName, Role from Users where UserName=? and Password=?");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $password);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$_SESSION['userID'] = $row['ID'];
			$_SESSION['realName'] = $row['RealName'];
			$_SESSION['role'] = $row['Role'];
			$_SESSION['userName'] = $username;
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

/**
 * Insert a new user into the user database.
 * @param username $username
 * @param password $password
 * @param Real name $realName
 * @return 0 on failure, 1 on success.
 */
function signUp($username, $password, $realName)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("insert into Users(UserName, Password, RealName, Role) Values (?, ?, ?, '1')");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $password);
		$stmt->bindValue(3, $realName);
		$stmt->execute();
		$_SESSION['userID'] = $DBH->lastInsertId();
		$_SESSION['userName'] = $username;
		$_SESSION['realName'] = $realName;
		$_SESSION['role'] = 1;
		return 1;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

/**
 * Returns whether a username is free.
 * @param username $username
 * @return 1 if username is free, 0 otherwise
 */
function usernameFree($username)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select * from Users where UserName=?");
		$stmt->bindValue(1, $username);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			return 0;
		}
		return 1;
	}
	catch(Exception $e)
	{
		reportDBError($e);
		return 0;
	}
}

// Check to see if a resume exists.
// Updated for ps6
function resumeExists($resumeName)
{
	try{
		$ID = -1;
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select ID from Resumes where Name=? and UserID=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->bindValue(2, $_SESSION['userID']);
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
// Updated for ps6
function getResume($resumeName, $userName, &$name, &$address, &$phone, &$position, &$beg, &$end, &$job){
	try{
		$userID = -1;
		$ID = -1;
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select ID from Users where UserName=?");
		$stmt->bindValue(1, $userName);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$userID = $row['ID'];
		}
		else
			return 0;
		
		// First get from the Resume table.
		$stmt = $DBH->prepare("select ID, ContactName, ContactAddress, ContactPhone, Position from Resumes where Name=? and UserID=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->bindValue(2, $userID);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$ID = $row['ID'];
			$name = $row['ContactName'];
			$address = $row['ContactAddress'];
			$phone = $row['ContactPhone'];
			$position = $row['Position'];
		}

		// If we got something out of the resume table, now get the pastEmployInfo.
		if($ID != -1)
		{
			$stmt = $DBH->prepare("select StartDate, StopDate, PastEmployDesc from PastEmployInfo where ResumeID=?");
			$stmt->bindValue(1, $ID);
			$stmt->execute();

			while($row = $stmt->fetch())
			{
				array_push($beg, $row['StartDate']);
				array_push($end, $row['StopDate']);
				array_push($job, $row['PastEmployDesc']);
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
// Updated for ps6
function loadResume($resumeName){
	try{
		$ID = -1;
		$DBH = openDBConnection();
		// First get from Resumes table.
		$stmt = $DBH->prepare("select ID, ContactName, ContactAddress, ContactPhone, Position from Resumes where Name=? and UserID=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->bindValue(2, $_SESSION['userID']);
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
			$stmt = $DBH->prepare("select StartDate, StopDate, PastEmployDesc from PastEmployInfo where ResumeID=?");
			$stmt->bindValue(1, $ID);
			$stmt->execute();

			$beg = array();
			$end = array();
			$job = array();

			while($row = $stmt->fetch())
			{
				array_push($beg, $row['StartDate']);
				array_push($end, $row['StopDate']);
				array_push($job, $row['PastEmployDesc']);
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
// Updated for ps6
function storeResume($resumeName)
{
	try{
		$ID = -1;
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("select ID from Resumes where Name=? and UserID=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->bindValue(2, $_SESSION['userID']);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$ID = $row['ID'];
		}

		// If the ID already existed, update it.
		if($ID != -1)
		{
			$stmt = $DBH->prepare("update Resumes set ContactName=?, ContactAddress=?, ContactPhone=?, Position=? where ID=?");
			$stmt->bindValue(1, $_SESSION['name']);
			$stmt->bindValue(2, $_SESSION['address']);
			$stmt->bindValue(3, $_SESSION['phone']);
			$stmt->bindValue(4, $_SESSION['position']);
			$stmt->bindValue(5, $ID);
			$stmt->execute();

			// Delete any past employ info.
			$stmt = $DBH->prepare("delete from PastEmployInfo where ResumeID=?");
			$stmt->bindValue(1, $ID);
			$stmt->execute();
		}
		// Otherwise, insert it into the table.
		else
		{
			$stmt = $DBH->prepare("insert into Resumes (Name, ContactName, ContactAddress, ContactPhone, Position, UserID)
					Values (?, ?, ?, ?, ?, ?)");
			$stmt->bindValue(1, $_SESSION['resumeName']);
			$stmt->bindValue(2, $_SESSION['name']);
			$stmt->bindValue(3, $_SESSION['address']);
			$stmt->bindValue(4, $_SESSION['phone']);
			$stmt->bindValue(5, $_SESSION['position']);
			$stmt->bindValue(6, $_SESSION['userID']);
			$stmt->execute();
			$ID = $DBH->lastInsertId();
		}

		// Insert new past Employ info.
		for($i = 0; $i < count($_SESSION['beg']); $i++)
		{
			$stmt = $DBH->prepare("insert into PastEmployInfo (ResumeID, StartDate, StopDate, PastEmployDesc)
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
// Update for ps6
function deleteResume($resumeName)
{
	try{
		$DBH = openDBConnection();
		$stmt = $DBH->prepare("delete from Resumes where Name=? and UserID=?");
		$stmt->bindValue(1, $resumeName);
		$stmt->bindValue(2, $_SESSION['userID']);
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