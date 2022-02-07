<?php require_once('Adapter.php'); ?>
<?php

class Product{

	public function gridAction()
	{
		//echo "111";
		require_once('product_grid.php');
	}

	public function saveAction()
	{
		try
		{
			if(!isset($_POST['product']))
			{
				throw new Exception("Request Invelid", 1);
				
			}
			$adapter=new Adapter();
			$row=$_POST['product'];
			$name=$_POST['product']['name'];
			$price=$_POST['product']['price'];
			$quantity=$_POST['product']['quantity'];
			$status=$_POST['product']['status'];
			$date=date('y-m-d h:m:s');

			if(array_key_exists('product_id',$row))
			{
				$product_id=$_POST['product']['product_id'];
				if(!(int)$row['product_id'])
				{
					throw new Exception("Invelid Request", 1);
					
				}
				$updateQuery="UPDATE `product` SET `name` = '$name', `price` = '$price', `quantity` = '$quantity', `status` = '$status', `updated_date` = '$date' WHERE `product`.`product_id` = $product_id";
				$update=$adapter->update($updateQuery);
				if(!$update)
				{
					throw new Exception("System unable to update", 1);
					
				}
			}
			else
			{
				$insertQuery="INSERT INTO `product` ( `name`, `price`, `quantity`, `status`, `created_date`) VALUES ( '$name', '$price', '$quantity', '$status', '$date')";
				$insert=$adapter->insert($insertQuery);
				if(!$insert)
				{
					throw new Exception("System unable to insert", 1);
					
				}

			}
			$this->redirect('product.php?a=gridAction');
			
		}
		catch(Exception $e)
		{
			$this->redirect('product.php?a=gridAction');
		}
	}

	public function editAction()
	{
		require_once('product_edit.php');
	}

	public function addAction()
	{
		require_once('product_add.php');
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
			$deleteQuery="DELETE FROM `product` WHERE `product`.`product_id` = '$id'";
			$delete=$adapter->delete($deleteQuery);
			if(!$delete)
			{
				throw new Exception("Invelid Request", 1);
			}
			$this->redirect('product.php?a=gridAction');
		}
		catch(Exception $e)
		{
			$this->redirect('product.php?a=gridAction');	
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
$product = new Product();
$product->$action();

?>