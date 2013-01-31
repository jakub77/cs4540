<!--
Jakub Szpunar
CS4540 Web Software Architecture Spring 2013
PS2
January 2013
-->

<!-- 
Default form page.
-->

<html>
	<head>
	    <link rel="stylesheet" type="text/css" href="style.css">
		<title>
		</title>
	</head>
	<body>
		<form method="get">
			<table id = 'table1'>
				<?php 
				// Loop through creating the four quadrants.				
				for($i=0; $i<4;$i++){
					// Create a new row if needed.
					if($i % 2 == 0)
						echo "<tr>\n";
					// Write out the caption.
					echo "<td> Caption: <input type = 'text' id = 'caption$i' name = 'caption$i' value = '$selectedCaptions[$i]' /><b id = 'error'>$captionErrors[$i]</b><br>\n";
					
					// Create the color selecter and options.
					echo "<select name = 'color$i'>\n";
					echo "<option value='Black'";				
					if($selectedColors[$i] == "Black")
						echo "selected='true'";					
					echo ">Black</option>\n";
					
					echo "<option value='Blue'";
					if($selectedColors[$i] == "Blue")
						echo "selected='true'";
					echo ">Blue</option>\n";
					
					echo "<option value='Red' ";					
					if($selectedColors[$i] == "Red")
						echo "selected='true'";
					echo ">Red</option>\n";
					
					echo "<option value='Yellow' ";					
					if($selectedColors[$i] == "Yellow")
						echo "selected='true'";
					echo ">Yellow</option>\n";
					echo "</select><b id = 'error'>$colorErrors[$i]</b><br>\n";
					
					// Draw the images and radio buttons to the page.
					echo "<img src='$catImage' id='thumbnail' />";
					echo "<input type='radio' name='group$i' value='Cat' ";
					if($selectedImages[$i] == "Cat")
						echo "checked='checked'";
					echo ">Cat<br>\n";
					
					echo "<img src='$dogImage' id='thumbnail' />";
					echo "<input type='radio' name='group$i' value='Dog' ";
					if($selectedImages[$i] == "Dog")
						echo "checked='checked'";
					echo ">Dog<br>\n";
					
					echo "<img src='$frogImage' id='thumbnail' />";
					echo "<input type='radio' name='group$i' value='Frog' ";
					if($selectedImages[$i] == "Frog")
						echo "checked='checked'";
					echo ">Frog<br>\n";
					
					echo "<img src='$horseImage' id='thumbnail' />";
					echo "<input type='radio' name='group$i' value='Horse' ";
					if($selectedImages[$i] == "Horse")
						echo "checked='checked'";
					echo ">Horse";
					echo "<b id = 'error'> $imageErrors[$i]</b></td>\n";
					// End the table row if needed.
					if($i%2==1)
						echo "</tr>\n";	
				}
				?>		
				<tr><td colspan = "2" id="submit"><input type="submit" value="Submit" /></td></tr>
			</table>
		</form>
	</body>
</html>
