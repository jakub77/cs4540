<!doctype html>
<!-- Jakub Szpunar CS4540 PS6 -->

<html>

<head>
<script>
// Use javascript to open a new window. In order to open the window, make sure the 
// resume name is valid.
function openWindow()
{
	var str = document.getElementById('resumeName').value;
	if(/^[a-zA-Z]+$/.test(str) && str.length >= 5 && str.length <= 20)
		window.open("resume.php?name=" + str);	
}
</script>

<title>Archive</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>

<body>
	<h2>Resume Archive</h2>

	<ul>
		<li><a href="contact.php">Contact information</a>
		</li>
		<li><a href="history.php">Employment history</a>
		</li>
		<li><a href="position.php">Position wanted</a></li>
		<li><a target="resume" href="resume.php">View resume</a></li>
		<?php 
		if($_SESSION['role'] != 0)
			echo "<li> <a href=\"logout.php\">Logout " . $_SESSION['realName'] . "</a></li>";
		if($_SESSION['role'] == 2)
			echo "<li> <a href=\"admin.php\">Admin Page</a></li>";
		?>
	</ul>
	<form method="post">
		<table>
			<tr>
				<td <?php validate('resumeName') ?>>Name:</td>
				<td colspan="3"><input class="resumeName" type="text"
					id="resumeName" name="resumeName"
					value="<?php sticky('resumeName') ?>" /></td>
				<td></td>
				<td></td>
				<?php 
				// Print the error or message.
				if(strlen($error) != 0)
					echo "<td><font class='error'>$error</font></td>";
				else
					echo "<td>$message</td>";
				?>
			</tr>
			<tr>
				<td><input type="submit" name="save" value="Load" /></td>
				<td><input type="submit" name="save" value="Store" /></td>
				<td><input type="submit" name="save" value="Delete" /></td>
				<td><input type="submit" name="save" value="View"
					onClick="openWindow()" /></td>
			</tr>
		</table>
	</form>
</body>
</html>
