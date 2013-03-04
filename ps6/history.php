<?php
// Jakub Szpunar
// CS4540 PS6
// Get the utilities
require('application/utilities.php');

// Resume session
$isSubmission = resumeSession();

// If this was a submission
if ($isSubmission)
{	
	// Get parameters
	$beg = getParamA('beg', array());
    $end = getParamA('end', array());
    $job = getParamA('job', array());
    
    // Trim arrays to the same length and save to session
    $length = min(count($beg), count($end), count($job));
    $_SESSION['beg'] = array_slice($beg, 0, $length);
    $_SESSION['end'] = array_slice($end, 0, $length);
    $_SESSION['job'] = array_slice($job, 0, $length);
    
    for($i = 0; $i < count($beg); $i++)
    {
    	$_SESSION['beg'][$i] = htmlspecialchars(($_SESSION['beg'][$i]));
    	$_SESSION['end'][$i] = htmlspecialchars(($_SESSION['end'][$i]));
    	$_SESSION['job'][$i] = htmlspecialchars(($_SESSION['job'][$i]));
    }
}

// Compose JavaScript that will create job forms
$jobs = '';
for ($i = 0; $i < count($_SESSION['beg']); $i++) 
{
	$sVal = $_SESSION['beg'][$i];
	$eVal = $_SESSION['end'][$i];
	$jVal = $_SESSION['job'][$i];
	$jVal = strtr($jVal, array("\r" => "\\r",
			 				   "\n" => "\\n"));
    $sErr = check($sVal);
    $eErr = check($eVal);
    $jErr = check($jVal);
    $jobs .= "addJob('$sVal', '$eVal', '$jVal', $sErr, $eErr, $jErr);\n";
}

// Output the HTML
require("views/history.php");

?>
