<!DOCTYPE html>
<html>

<head>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<script>
// Disables the submit button depending on quantity in box
function checkQuantity (box) {
	var value = box.value;
	if (/^\d+$/.test(value) && parseInt(value)>0) {
		$("input[type=submit]").removeAttr("disabled");
	}
	else {
		$("input[type=submit]").attr("disabled", "disabled");
	}	
}
</script>

<title>Girl Scout Cookie Order Form</title>
</head>

<body
 onload="checkQuantity(document.getElementById('quantity'));">

<h2>Girl Scout Cookie Order Form</h2>

<p>Please use the form below to add boxes of cookies to your shopping cart.
Thank you!</p>

<!-- This form has no action, so it is submitted to the page on which it appears. -->
<form method="get">

<!-- Hidden field to identify real submissions -->
<input type="hidden" name="submission" value="no"/>

<table>

 <tr>
  <td>Variety</td>
  <td>Quantity</td>
 </tr>

 <tr>
  <td>
   <select name="variety" onchange="submit();">
    <?php echo $cookieOptions ?>
   </select>
  </td>

  <td><input type="text" id="quantity" name="quantity" 
             value="<?php echo $quantityDisplay ?>"
             onkeyup="checkQuantity(this);" /></td>

  <!-- Set the hidden field to "yes" -->
  <td><input type="submit" disabled="disabled"
             onclick="submission.value='yes'; true" 
             value="Add to Cart"/></td>
  
  <td style="color:red"><?php echo $quantityMessage ?></td>
 </tr>
 
</table>

<!-- This is where cookie images are placed. -->
<p><img src="<?php echo $cookieImage ?>"/></p>

</form>
</body>

</html>
