<?php require_once('Adapter.php'); ?>
<?php

class Category{

	public function gridAction()
	{
		//echo "111";
		require_once('category_grid.php');
	}

	public function saveAction()
	{
		try
		{
			if(!isset($_POST['category']))
			{
				throw new Exception("Request Invelid", 1);
				
			}
			$adapter=new Adapter();
			$row=$_POST['category'];
			$name=$_POST['category']['name'];
			$status=$_POST['category']['status'];
			$date=date('y-m-d h:m:s');

			
			if(array_key_exists('category_id',$row))
			{
				$category_id=$_POST['category']['category_id'];
				if(!(int)$row['category_id'])
				{
					throw new Exception("Invelid Request", 1);
					
				}
				$updateQuery="UPDATE `category` SET `name` = '$name', `status` = '$status', `updated_date` = '$date' WHERE `category`.`category_id` = $category_id";
				$update=$adapter->update($updateQuery);
				if(!$update)
				{
					throw new Exception("System unable to update", 1);
					
				}
			}
			else
			{
				$insertQuery="INSERT INTO `category` ( `name`, `status`, `created_date`) VALUES ( '$name','$status', '$date')";
				$insert=$adapter->insert($insertQuery);
				if(!$insert)
				{
					throw new Exception("System unable to insert", 1);
					
				}

			}
			$this->redirect('category.php?a=gridAction');
			
		}
		catch(Exception $e)
		{
			$this->redirect('category.php?a=gridAction');
		}
		echo "";
	}

	public function editAction()
	{
		require_once('category_edit.php');
	}

	public function addAction()
	{
		require_once('category_add.php');
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
			$deleteQuery="DELETE FROM `category` WHERE `category`.`category_id` = '$id'";
			$delete=$adapter->delete($deleteQuery);
			if(!$delete)
			{
				throw new Exception("Invelid Request", 1);
			}
			$this->redirect('category.php?a=gridAction');
		}
		catch(Exception $e)
		{
			$this->redirect('category.php?a=gridAction');	
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
$category = new category();
$category->$action();

?>