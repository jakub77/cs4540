<!doctype html>
<!-- Jakub Szpunar CS4540 PS6 -->
<html>

<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>

<body>
	<h2>Login</h2>
	<form method="post">
		<table class="block">
			<tr>
				<td <?php validate('regUserName') ?>>User name:</td>
				<td><input class="register" type="text" name="userName"
					value="<?php sticky('regUserName') ?>" /></td>
			</tr>
			<tr>
				<td <?php validate('regPass1') ?>>Password:</td>
				<td><input class="register" type="password" name="password1"
					value="<?php sticky('regPass1') ?>" /></td>
			</tr>
			<tr>
			<td colspan = '2'>
				<?php echo "$error";?>
			</td>
			</tr>
		</table>
		<p>
			<input type="submit" name="save" value="Login" />
			<input type="submit" name="save" value="Cancel" />
		</p>
	</form>
</body>
</html>
