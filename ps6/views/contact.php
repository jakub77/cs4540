<!doctype html>
<!-- Jakub Szpunar CS4540 PS6 -->
<html>

<head>
<title>Contact Information</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>

<body>

	<h2>Contact Information</h2>

	<ul>
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

	<p>Please enter your contact information.</p>

	<form method="post">

		<table class="block">
			<tr>
				<td <?php validate('name') ?>>Name</td>
				<td><input class="contact" type="text" name="name"
					value="<?php sticky('name') ?>" /></td>
			</tr>
			<tr>
				<td <?php validate('address') ?>>Address</td>
				<td><input class="contact" type="text" name="address"
					value="<?php sticky('address') ?>" /></td>
			</tr>
			<tr>
				<td <?php validate('phone') ?>>Phone</td>
				<td><input class="contact" type="text" name="phone"
					value="<?php sticky('phone') ?>" /></td>
			</tr>
		</table>

		<p>
			<input type="submit" name="save" value="Save" />
		</p>

	</form>
</body>
</html>
