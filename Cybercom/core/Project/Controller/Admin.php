<?php require_once('Model/Core/Adapter.php'); ?>
<?php

class Controller_Admin{

	public function gridAction()
	{
		require_once('view/admin/grid.php');
	}

	public function addAction()
	{
		require_once('view/admin/add.php');
	}

	public function editAction()
	{
		require_once('view/admin/edit.php');
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
			$admin=$adapter->delete("DELETE FROM `admin` WHERE `admin`.`admin_id` = '$id'");
			if(!$adapter)
			{
				throw new Exception("System Enable to Delete Record",1);
			}
			//echo "query done";
			$this->redirect('index.php?c=admin&a=grid');

		}
		catch(Exception $e)
		{
			echo "catch";
			$this->redirect('index.php?c=admin&a=grid');
		}
	}

	protected function saveadmin()
	{
			if(!isset($_POST['admin']))
			{
				throw new Exception("Request Invelid.",1);
			}

			$adapter=new Adapter();
			$row=$_POST['admin'];
			//print_r($row);
			$firstName=$_POST['admin']['firstName'];
			$lastName=$_POST['admin']['lastName'];
			$email=$_POST['admin']['email'];
			$password=$_POST['admin']['password'];
			$status=$_POST['admin']['status'];
			$date=date('y-m-d h:m:s');

			if(array_key_exists('admin_id',$row))
			{


				$admin_id=$_POST['admin']['admin_id'];
				if(!(int)$row['admin_id'])
				{
					throw new Exception("Invelid Request.",1);
				}
				$updateAdminQuery="UPDATE `admin` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `password` = '$password', `status` = '$status', `updated_date` = '$date' WHERE `admin`.`admin_id` = $admin_id";
				$update=$adapter->update($updateAdminQuery);
				if(!$update)
				{	
					throw new Exception("System is unable to Update.",1);
				}
			}
			else
			{
				$insertAdminQuery="INSERT INTO `admin` ( `firstName`, `lastName`, `email`, `password`, `status`, `created_date`) VALUES ( '$firstName', '$lastName', '$email', '$password', '$status', '$date')";
				$insert=$adapter->insert($insertAdminQuery);
				if(!$insert)
				{	
					throw new Exception("System unable to insert.", 1);
					
				}
				return $insert;
			}
		

	}
	public function saveAction()
	{
		try
		{
			$admin_id=$this->saveAdmin();

			$this->redirect('index.php?c=admin&a=grid');
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=admin&a=grid');
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