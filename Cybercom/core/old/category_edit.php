<?php

include 'Adapter.php';

$id=$_GET['id'];

$adapter=new Adapter();
$result=$adapter->select_update("select * FROM `category` WHERE `category`.`category_id` = '$id'");


?>


<html>
<head><title>Category Edit</title></head>
<body>
<form action="category_save.php" method="POST">
	<input type="text" name="id" value="<?php echo $id; ?>" hidden>
	<br>Name:<input type='text' value="<?php echo $result[1]; ?>" name='name' id='name'>
	<br>Status:<input type='radio' value="active" name='status' id='active' <?php if($result[2]=='active'){echo "checked";} ?>>Active<input type='radio' name='status' value='inactive' id='inactive' <?php if($result[2]=='inactive'){echo "checked";} ?>>Inactive
	<br><input type='submit' name='Update' id='submit' value='update'>
</form>
</body>
</html>