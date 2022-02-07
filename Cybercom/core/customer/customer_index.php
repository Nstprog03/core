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
		try
		{
			if(!isset($_POST['customer']))
			{
				throw new Exception("Request Invelid.",1);
			}

			$adapter=new Adapter();
			$row=$_POST['customer'];
			//print_r($row);
			$firstName=$_POST['customer']['firstName'];
			$lastName=$_POST['customer']['lastName'];
			$email=$_POST['customer']['email'];
			$mobile=$_POST['customer']['mobile'];
			$status=$_POST['customer']['status'];
			$date=date('y-m-d h:m:s');

			$address_detail=$_POST['address']['address_detail'];
			$postalCode=$_POST['address']['postalCode'];
			$city=$_POST['address']['city'];
			$state=$_POST['address']['state'];
			$country=$_POST['address']['country'];
			$billing=$_POST['address']['billing'];
			$shiping=$_POST['address']['shiping'];
			//print_r($_POST);
			//exit();

			if(array_key_exists('customer_id',$row))
			{
				

				$customer_id=$_POST['customer']['customer_id'];
				if(!(int)$row['customer_id'])
				{
					throw new Exception("Invelid Request.",1);
				}
				$updateCustomerQuery="UPDATE `customer` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `mobile` = '$mobile', `status` = '$status', `updated_date` = '$date' WHERE `customer`.`customer_id` = $customer_id";
				$update=$adapter->update($updateCustomerQuery);
				if(!$update)
				{	
					throw new Exception("System is unable to Update.",1);
				}
				$updateAddressQuery="UPDATE `address` SET `address` = '$address_detail', `postalCode` = '$postalCode', `city` = '$city', `state` = '$state', `billing` = '$billing', `shiping` = '$shiping' WHERE `address`.`customer_id` = $customer_id";
				$update=$adapter->update($updateAddressQuery);
				if(!$update)
				{	
					throw new Exception("System is unable to Update.",1);
				}

			}
			else
			{
				$insertCustomerQuery="INSERT INTO `customer` ( `firstName`, `lastName`, `email`, `mobile`, `status`, `created_date`) VALUES ( '$firstName', '$lastName', '$email', '$mobile', '$status', '$date')";
				$insert=$adapter->insert($insertCustomerQuery);
				if(!$insert)
				{	
					throw new Exception("System unable to insert.", 1);
					
				}
				$last_id=$adapter->getConnect()->insert_id;
				$insertAddressQuery="INSERT INTO `address` (`customer_id`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shiping`) VALUES ( '$last_id', '$address_detail', '$postalCode', '$city', '$state', '$country', '$billing', '$shiping');";
				$insert=$adapter->insert($insertAddressQuery);
				if(!$insert)
				{	
					throw new Exception("System unable to insert.", 1);
					
				}

			}
			$this->redirect('customer_index.php?a=gridAction');
			
		}
		catch(Exception $e)
		{
			$this->redirect('customer_index.php?a=gridAction');
		}
		echo "";
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
		
		try
		{

			if(!isset($_GET['id']))
			{
				throw new Exception("Invelid Request", 1);	
			}	
			$id=$_GET['id'];
			$adapter =new Adapter();
			$customer=$adapter->delete("DELETE FROM `customer` WHERE `customer`.`customer_id` = '$id'");
			if(!$adapter)
			{
				throw new Exception("System Enable to Delete Record",1);
			}
			$eddress=$adapter->delete("DELETE FROM `address` WHERE `address`.`customer_id` = '$id'");
			if(!$adapter)
			{
				throw new Exception("System Enable to Delete Record",1);
			}
			//echo "query done";
			$this->redirect('customer_index.php?a=gridAction');

		}
		catch(Exception $e)
		{
			echo "catch";
			$this->redirect('customer_index.php?a=gridAction');
		}
	}
	public function errorAction()
	{
		echo "error";
	}
	public function redirect($url)
	{
		header("location:$url");
		exit();
	}


}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$customer = new Customer();
$customer->$action();

?>