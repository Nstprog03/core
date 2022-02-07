<?php require_once('Adapter.php'); ?>
<?php

class Customer{

	public function gridAction()
	{
		//echo "111";
		require_once('customer_grid.php');
	}

	public function saveAction()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$adapter=new Adapter();
			
			$firstName=$_POST['customer']['firstName'];
			$lastName=$_POST['customer']['lastName'];
			$email=$_POST['customer']['email'];
			$mobile=$_POST['customer']['mobile'];
			$status=$_POST['customer']['status'];
			$date=date('y-m-d h:m:s');

			if($_POST["submit"]=="Save")
			{
				$customer=$adapter->insert("INSERT INTO `customer` ( `firstName`, `lastName`, `email`, `mobile`, `status`, `created_date`) VALUES ( '$firstName', '$lastName', '$email', '$mobile', '$status', '$date')");
				if($customer)
				{
					header('Location: customer_index.php?a=gridAction');
				}

			}
			if($_POST["submit"]=="update")
			{
				$id=$_GET['id'];
				$customer=$adapter->update("UPDATE `customer` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `mobile` = '$mobile', `status` = '$status', `updated_date` = '$date' WHERE `customer`.`customer_id` = $id");
				if($customer)
				{
					header('Location: customer_index.php?a=gridAction');
				}

			}
			
		}
	}

	public function editAction()
	{
		require_once('customer_edit.php');
	}

	public function addAction()
	{
		require_once('customer_add.php');
	}

	public function deleteAction()
	{
		
		if($_SERVER['REQUEST_METHOD']=='GET')
		{

				$id=$_GET['id'];
				$adapter =new Adapter();
				$customer=$adapter->delete("DELETE FROM `customer` WHERE `customer`.`customer_id` = '$id'");
				if($customer)
				{
					echo "111";
					header('Location: customer_index.php?a=gridAction');
				}
		}
	}

	public function errorAction()
	{
		echo "error";
	}


}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$customer = new Customer();
$customer->$action();

?>