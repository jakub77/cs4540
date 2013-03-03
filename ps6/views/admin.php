<!doctype html>
<!-- Jakub Szpunar CS4540 PS6 -->
<html>

<head>
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>
<body>
	<h2>Admin Page</h2>
	<ul>
		<li><a href="contact.php">Contact information</a></li>
		<li><a href="history.php">Employment history</a></li>
		<li><a href="position.php">Position wanted</a></li>
		<li><a href="archive.php">Resume Archive</a></li>
		<li><a href="logout.php">Logout <?php echo $_SESSION['realName'];?></a></li>
		<li><a target="resume" href="resume.php">View resume</a></li>
	</ul>	
	
	<form method="post">
		<table class="block" cellpadding="5">
			<tr>
				<td>Username</td>
				<td>Real Name</td>
				<td>Role</td>
				<td>Swap Role</td>
				<td>Delete</td>
			</tr>

			<?php 
			for ($i = 0; $i < count($userNames); $i++)
			{
				echo "<tr><td>$userNames[$i]</td>";
				echo "<td> $realNames[$i] </td>";
				if($roles[$i] == 2)
					echo "<td>Admin</td>";
				else
					echo "<td>User</td>";
				echo "<td><input type = 'submit' name = 'swap$i' value = 'swap' /></td>";
				echo "<td><input type = 'submit' name = 'delete$i' value = 'delete' /></td>";
				echo "</tr>";
			}
			?>
		</table>
	</form>
	<p>Warning: Swapping your role or deleting yourself will work, and you will be logged out and unable to access this page anymore!</p>
</body>
</html>
