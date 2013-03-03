<!doctype html>
<!-- Jakub Szpunar CS4540 PS5 -->
<html>

<head>
<title>Bad Roll</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>

<body>

	<h2>Bad Roll</h2>

	<ul>
		<li><a href="contact.php">Contact information</a>
		</li>
		<li><a href="history.php">Employment history</a></li>
		<li><a href="position.php">Position wanted</a></li>
		<li><a target="resume" href="resume.php">View resume</a></li>
		<?php 
		if($_SESSION['role'] != 0)
		{
			echo "<li> <a href=\"archive.php\">Resume Archive</a></li>";
			echo "<li> <a href=\"logout.php\">Logout " . $_SESSION['realName'] . "</a></li>";
		}
		if($_SESSION['role'] == 2)
			echo "<li> <a href=\"admin.php\">Admin Page</a></li>";
		if($_SESSION['role'] == 0)
		{
			echo "<li> <a href=\"login.php\">Login</a></li>";
			echo "<li> <a href=\"register.php\">Register</a></li>";
		}
		?>
	</ul>

	<h1>Bad Roll</h1>

	<form method="post">
		<input type="submit" name="save" value="OK" />
	</form>
</body>
</html>
