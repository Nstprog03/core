<?php
include 'Adapter.php';


if($_SERVER['REQUEST_METHOD']=='POST')
{
	if($_POST["submit"]=="save")
	{
		$adapter=new Adapter();
		$name=$_POST["name"];
		$price=$_POST["price"];
		$quantity=$_POST["quantity"];
		$status=$_POST["status"];
		$date=date('y-m-d h:m:s');
		$result=$adapter->insert("INSERT INTO `products` (`name`, `price`, `quantity`, `pro_status`, `created_date`) VALUES ('$name', '$price', '$quantity', '$status', '$date')");
		if($result)
		{
			header('Location: product_grid.php');
		}

	}
	if($_POST["Update"]=="update")
	{
		$adapter=new Adapter();
		$id=$_POST["id"];
		$name=$_POST["name"];
		$price=$_POST["price"];
		$quantity=$_POST["quantity"];
		$status=$_POST["status"];
		$date=date('y-m-d h:m:s');
		$result=$adapter->update("UPDATE `products` SET `name` = '$name', `price` = '$price', `quantity` = '$quantity', `pro_status` = '$status',`updated_date`='$date' WHERE `products`.`product_id` = $id");
		if($result)
		{
			header('Location: product_grid.php');
		}

	}
	
}


?>