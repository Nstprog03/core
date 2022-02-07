<?php

include 'Adapter.php';
if($_SERVER['REQUEST_METHOD']=='GET')
{
		$id=$_GET['id'];
		$adapter =new Adapter();
		$result=$adapter->delete("DELETE FROM `category` WHERE `category`.`category_id` = '$id'");
		if($result)
		{
			header('Location: category_grid.php');
		}

}

?>
