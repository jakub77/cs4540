<!doctype html>
<!-- Jakub Szpunar CS4540 PS6 -->
<html>

<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="application/style.css" />

<script>
// Use javascript to validate input first.
// If it is valid, submits the document.
function validate()
{
	var user = document.getElementById('userName').value;
	var real = document.getElementById('realName').value;
	var pass1 = document.getElementById('pass1').value;
	var pass2 = document.getElementById('pass2').value;

	if(user.length == 0)
	{
		alert('Username must be filled in.');
		return false;
	}
	if(real.length == 0)
	{
		alert('Real name must be filled in.');
		return false;
	}
	if(pass1.length < 8)
	{
		alert('Password must be 8 character or longer');
		return false;
	}
	if(pass1 != pass2)
	{
		alert('Passwords do not match');
		return false;
	}
	return true;

	document.getElementById("regForm").submit();
}
</script>
</head>

<body>
	<h2>Register</h2>
	<form method="post" id = "regForm" onSubmit = "return validate()">
		<table class="block">
			<tr>
				<td <?php validate('regRealName') ?>>Real name:</td>
				<td><input class="register" type="text" name="realName"
					id="realName" value="<?php sticky('regRealName') ?>" /></td>
			</tr>
			<tr>
				<td <?php validate('regUserName') ?>>User name:</td>
				<td><input class="register" type="text" name="userName"
					id="userName" value="<?php sticky('regUserName') ?>" /></td>
			</tr>
			<tr>
				<td <?php validate('regPass1') ?>>Password:</td>
				<td><input class="register" type="password" name="password1"
					id="pass1" value="<?php sticky('regPass1') ?>" /></td>
			</tr>
			<tr>
				<td <?php validate('regPass2') ?>>Password:</td>
				<td><input class="register" type="password" name="password2"
					id="pass2" value="<?php sticky('regPass2') ?>" /></td>
			</tr>
			<tr>
				<td colspan='2'><?php echo "$error";?>
				</td>
			</tr>
		</table>
		<p> <!-- Submit buttons. Register submits through the validator, Cancel goes back a page -->
			<input type="submit" name="save" value="Register" /> <input
				type="button" name="save" value="Cancel" onClick="window.history.back()" />
		</p>
	</form>
</body>
</html>
