<?php
// Jakub Szpunar
// CS4540 PS5

// Get the utilities
require('application/utilities.php');
require('application/db.php');

// Resume session
$isSubmission = resumeSession();
$resumeName = getParam('resumeName', "");
$error = "";
$message = "";
$bodyOnLoad = "";
if($isSubmission)
{
	// Validate the name.
	if(validateResumeName(getParam('resumeName', '')) == 0)
		$error = "Name must be 5-20 alpha characters.";
	else
	{
		// Depending on what button was pressed, take the appropriate action.
		$_SESSION['resumeName'] = getParam('resumeName', '');
		$isView = 0;
		switch($_REQUEST['save'])
		{
			// For each case, set error messages if appropriate.
			case 'View':
				if(resumeExists($_REQUEST['resumeName']) == 0)
					$error = "Could not find that resume.";
				break;
			case 'Load':
				if(loadResume($_REQUEST['resumeName']) == 0)
					$error = "Could not find that resume.";
				else
					$message = "Load Success";
				break;
			case 'Store':
				if(storeResume($_REQUEST['resumeName']) == 0)
					$error = "Could not save resume, try again later.";
				else
					$message = "Store Success";
				break;
			case 'Delete':
				if(deleteResume($_REQUEST['resumeName']) == 0)
					$error = "Could not find that resume.";
				else
					$message = "Delete Success";
				break;
		}
	}
}

// Output the HTML
require("views/archive.php");

// Validate the name is of correct length and content.
function validateResumeName ($param)
{
	if(strlen($param) < 5 || strlen($param) > 20)
		return 0;

	if(ctype_alpha($param))
		return 1;
	return 0;
}
?>
