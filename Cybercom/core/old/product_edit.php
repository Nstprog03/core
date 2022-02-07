<?php

include 'Adapter.php';

$id=$_GET['id'];

$adapter=new Adapter();
$result=$adapter->select_update("select * FROM `products` WHERE `products`.`product_id` = '$id'");


?>


<html>
<head><title>Edit</title></head>
<body>
<form action="product_save.php" method="POST">
	<input type="text" name="id" value="<?php echo $id; ?>" hidden>
	<br>Name:<input type='text' value="<?php echo $result[1]; ?>" name='name' id='name'>
	<br>Prize:<input type='float' value="<?php echo $result[2]; ?>" name='price' id='price'>
	<br>Quantity:<input type='number' value="<?php echo $result[3]; ?>" name='quantity' id='quantity'>
	<br>Status:<input type='radio' value="active" name='status' id='active' <?php if($result[4]=='active'){echo "checked";} ?>>Active<input type='radio' name='status' value='inactive' id='inactive' <?php if($result[4]=='inactive'){echo "checked";} ?>>Inactive
	<br><input type='submit' name='Update' id='submit' value='update'>
</form>
</body>
</html>