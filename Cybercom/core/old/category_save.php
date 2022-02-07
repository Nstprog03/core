<?php
include 'Adapter.php';


if($_SERVER['REQUEST_METHOD']=='POST')
{
	if($_POST["submit"]=="save")
	{
		$adapter=new Adapter();
		$name=$_POST["name"];
		$status=$_POST["status"];
		$date=date('y-m-d h:m:s');
		$result=$adapter->insert("INSERT INTO `category` (`name`, `cat_status`, `created_date`) VALUES ('$name', '$status', '$date')");
		echo $result;
		if($result)
		{
			echo "res";
			header('Location: category_grid.php');
		}

	}
	else
	{
		$adapter=new Adapter();
		$id=$_POST["id"];
		$name=$_POST["name"];
		$status=$_POST["status"];
		$date=date('y-m-d h:m:s');
		$result=$adapter->update("UPDATE `category` SET `name` = '$name', `cat_status` = '$status',`updated_date`='$date' WHERE `category`.`category_id` = $id");
		if($result)
		{
			header('Location: category_grid.php');
		}

	}
	
}


?>