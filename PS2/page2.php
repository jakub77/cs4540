<!--
Jakub Szpunar
CS4540 Web Software Architecture Spring 2013
PS2
January 2013
-->

<!-- 
After successful submit page.
-->

<html>
	<head>
	    <link rel="stylesheet" type="text/css" href="style.css">
		<title>
		</title>
	</head>
	<body>
		<form method="get">
			<table id = 'table2'>
				<?php 			
				// Loop through the four quadrents.					
				for($i=0; $i<4;$i++){
					// Make a new row if needed.
					if($i % 2 == 0)
						echo "<tr>\n";
					
					// Get the needed info from the get request.
					$image = "images/" . strtolower($_GET["group$i"]) . ".jpg";
					$caption = $_GET["caption$i"];
					$color = $_GET["color$i"];
					
					// Display the image and caption.
					echo "<td>\n";
					echo "<img src = '$image' id = 'fullImage'/><br>\n";
					echo "<font color = '$color'>$caption</font><br>\n";
					echo "</td>\n";
					
					// End a row if needed.
					if($i % 2 == 1)
						echo "</tr>\n";
				}
				?>		
			</table>
		</form>
		<!-- Create the return link for a fresh page. -->
		<h2><a href="index.php">Return</a></h2>
	</body>
</html>
