<!doctype html>
<!-- Jakub Szpunar CS4540 PS5 -->
<html>

<head>
<title><?php sticky('name')?></title>
<link rel="stylesheet" type="text/css" href="application/style.css" />
</head>

<body>
	<h3>
		<?php echo "$contactName"; ?>
		<br />
		<?php echo "$address"; ?>
		<br />
		<?php echo "$phone"; ?>
	</h3>
	<h4>Position Desired</h4>
	<p>
		<?php echo "$position"; ?>
	</p>

	<h4>Employment History</h4>

	<ul>
		<?php 
		for ($i = 0; $i < count($beg); $i++)
		{
			echo "<li>$beg[$i]--$end[$i] .  $job[$i]</li>";
		}
		?>
	</ul>
</body>
</html>
