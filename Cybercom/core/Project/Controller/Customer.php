<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		$adapter = new Adapter();
		$customers = $adapter->fetchAll("SELECT * FROM customer");
		$view = $this->getView();
		$view->setTemplate('view/customer/grid.php');
		$view->addData('customers',$customers);
		$view->toHtml();
		//require_once('view/customer/grid.php');
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/customer/add.php');
		$view->toHtml();
		//require_once('view/customer/.php');
	}

	public function editAction()
	{
		$adapter = new Adapter();
		try
		{
			$id=$_GET['id'];
			if(!$id)
			{
				throw new Exception("Invelid Request", 1);
				
			}

			$adapter=new Adapter();
			$customer=$adapter->fetchRow("select * FROM `customer` WHERE `customer`.`customer_id` = '$id'");
			$address=$adapter->fetchRow("select * FROM `address` WHERE `address`.`customer_id` = '$id'");
		}
		catch(Exception $e)
		{
			throw new Exception("Invelid Request", 1);
		}
		$view = $this->getView();
		$data=[$customer,$address];	
		$view->setTemplate('view/customer/edit.php');
		$view->addData('data',$data);
		$view->toHtml();	


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
			$this->redirect('index.php?c=customer&a=grid');

		}
		catch(Exception $e)
		{
			echo "catch";
			$this->redirect('index.php?c=customer&a=grid');
		}

	}

	protected function saveCustomer()
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
			}
			else
			{
				$insertCustomerQuery="INSERT INTO `customer` ( `firstName`, `lastName`, `email`, `mobile`, `status`, `created_date`) VALUES ( '$firstName', '$lastName', '$email', '$mobile', '$status', '$date')";
				$insert=$adapter->insert($insertCustomerQuery);
				if(!$insert)
				{	
					throw new Exception("System unable to insert.", 1);
					
				}
				return $insert;
			}
		

	}
	protected function saveAddress($customer_id)
	{
		if(!isset($_POST['address']))
		{
			throw new Exception("Missing Address data in Request", 1);
		}

		$adapter=new Adapter();
		$row=$_POST['customer'];
		$rowAddress=$_POST['address'];
			
		$address_detail=$_POST['address']['address_detail'];
		$postalCode=$_POST['address']['postalCode'];
		$city=$_POST['address']['city'];
		$state=$_POST['address']['state'];
		$country=$_POST['address']['country'];
		//$billing=$_POST['address']['billing'];
		//$shiping=$_POST['address']['shiping'];
		$billing = 0;
		if(array_key_exists('billing',$rowAddress) && $rowAddress['billing'] == 1){
			$billing = 1;
		}
		$shiping = 0;
		if(array_key_exists('shiping',$rowAddress) && $rowAddress['shiping'] == 1){
			$shiping = 1;
		}

		if(array_key_exists('customer_id',$row))
		{
			$customer_id=$_POST['customer']['customer_id'];
				
			$updateAddressQuery="UPDATE `address` SET `address` = '$address_detail', `postalCode` = '$postalCode', `city` = '$city', `state` = '$state', `billing` = '$billing', `shiping` = '$shiping' WHERE `address`.`customer_id` = $customer_id";
			$update=$adapter->update($updateAddressQuery);
			if(!$update)
			{	
				throw new Exception("System is unable to Update.",1);
			}
		}
		else
		{
			$insertAddressQuery="INSERT INTO `address` (`customer_id`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shiping`) VALUES ( '$customer_id', '$address_detail', '$postalCode', '$city', '$state', '$country', '$billing', '$shiping');";
			
			$insert=$adapter->insert($insertAddressQuery);
			
			if(!$insert)
			{	
				throw new Exception("System unable to insert.", 1);
					
			}
		}
	}

	public function saveAction()
	{
		try
		{
			$customer_id=$this->saveCustomer();
			$this->saveAddress($customer_id);

			$this->redirect('index.php?c=customer&a=grid');
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=customer&a=grid');
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

?>