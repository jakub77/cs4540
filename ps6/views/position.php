<!doctype html>
<!-- Jakub Szpunar CS4540 PS5 -->
<html>

<head>
<title>Position Sought</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>

<body>

	<h2>Position Sought</h2>

	<ul>
		<li><a href="contact.php">Contact information</a>
		</li>
		<li><a href="history.php">Employment history</a></li>
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

	<p>Please enter your contact information.</p>

	<form method="post">

		<table class="block">
			<tr>
				<td <?php validate('position') ?>>Position Sought</td>
				<td><textarea class="info" name="position">
						<?php sticky('position') ?>
					</textarea></td>
			</tr>
		</table>

		<p>
			<input type="submit" name="save" value="Save" />
		</p>

	</form>
</body>
</html>
