<?php

?>

<html>
	<head>
		<title>
		</title>
	</head>
	<body>
		<form method="get">
			<table>
				<?php 
				
				//$selectedCaptions = array("A","B","C","D");
				//$selectedColors = array("Black","Blue","Red","Yellow");
				//$selectedImages = array("Cat", "Dog", "Frog", "Horse");
				
				for($i=0; $i<4;$i++){
					if($i%2==0)
						echo "<tr>\n";
					echo "<td> Caption: <input type=\"text\" id=\"caption" . $i . "\" name = \"caption" . $i . "\" value=\"" . $selectedCaptions[$i] . "\"/><br>\n";
					
					echo "<select name = \"color" . $i ."\">\n";
					echo "<option value=\"Black\" ";				
					if($selectedColors[$i] == "Black")
						echo "selected=\"true\"";					
					echo ">Black</option>\n";
					echo "<option value=\"Blue\" ";
					
					if($selectedColors[$i] == "Blue")
						echo "selected=\"true\"";
					echo ">Blue</option>\n";
					echo "<option value=\"Red\" ";
					
					if($selectedColors[$i] == "Red")
						echo "selected=\"true\"";
					echo ">Red</option>\n";
					echo "<option value=\"Yellow\" ";
					
					if($selectedColors[$i] == "Yellow")
						echo "selected=\"true\"";
					echo ">Yellow</option>\n";
					echo "</select><br>\n";
					
					echo "<input type=\"radio\" name=\"group" . $i . "\" value=\"Cat\" ";
					if($selectedImages[$i] == "Cat")
						echo "checked=\"checked\"";
					echo ">Cat<br>\n";
					
					echo "<input type=\"radio\" name=\"group" . $i . "\" value=\"Dog\" ";
					if($selectedImages[$i] == "Dog")
						echo "checked=\"checked\"";
					echo ">Dog<br>\n";
					
					echo "<input type=\"radio\" name=\"group" . $i . "\" value=\"Frog\" ";
					if($selectedImages[$i] == "Frog")
						echo "checked=\"checked\"";
					echo ">Frog<br>\n";
					
					echo "<input type=\"radio\" name=\"group" . $i . "\" value=\"Horse\" ";
					if($selectedImages[$i] == "Horse")
						echo "checked=\"checked\"";
					echo ">Horse<br>\n";
					echo "</td>\n";
					if($i%2==1)
						echo "</tr>\n";	
				}
				?>		
				<tr><td><input type="submit" value="Submit"/></td></tr>
			</table>
		</form>
	</body>
</html>