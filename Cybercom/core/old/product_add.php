<?php



?>
<html>
<head><title>Add</title></head>
<body>
<form action="product_save.php" method="POST">
	<br>Name:<input type='text' name='name' id='name'>
	<br>Prize:<input type='float' name='price' id='price'>
	<br>Quantity:<input type='number' name='quantity' id='quantity'>
	<br>Status:<input type='radio' name='status' value='active' id='active'>Active<input type='radio' name='status' value='inactive' id='inactive'>Inactive
	<br><input type='submit' name='submit' id='submit' value='save'>
</form>
</body>
</html>