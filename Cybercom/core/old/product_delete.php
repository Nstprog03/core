<?php

include 'Adapter.php';
if($_SERVER['REQUEST_METHOD']=='GET')
{
		$id=$_GET['id'];
		$adapter =new Adapter();
		$result=$adapter->delete("DELETE FROM `products` WHERE `products`.`product_id` = '$id'");
		if($result)
		{
			header('Location: product_grid.php');
		}

}

?>
