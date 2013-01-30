<!DOCTYPE html>
<html>

<head>
<title>Girl Scout Cookie Order Form</title>
</head>

<body>

<h2>Girl Scout Cookie Order Form</h2>

<p>Please use the form below to add boxes of cookies to your 
shopping cart.  Thank you!</p>

<!-- This form has no action attribute, so it is submitted to the 
     page on which it appears. -->
<form method="get">

<table>

 <tr>
  <td>Variety</td>
  <td>Quantity</td>
 </tr>

 <tr>
  <td>
   <select name="variety">
    <?php echo $cookieOptions ?>
   </select>
  </td>

  <td><input type="text" name="quantity"/></td>

  <td><input type="submit" value="Add to Cart"/></td>
 </tr>
 
</table>

<!-- This is where cookie images are placed. -->
<p><img src="<?php echo $cookieImage ?>"/></p>

</form>
</body>

</html>


