<?php //require_once('Model/Core/Adapter.php'); ?>
<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		$adapter = new Adapter();
		$products = $adapter->fetchAll("SELECT * FROM product");
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('products',$products);
		$view->toHtml();
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
			$this->redirect('index.php?c=product&a=grid');
			
		}
		catch(Exception $e)
		{
			$this->redirect('index.php?c=product&a=grid');
		}
	}

	public function editAction()
	{
		
		$id=$_GET['id'];

		$adapter=new Adapter();
		$product=$adapter->fetchRow("select * FROM `product` WHERE `product`.`product_id` = '$id'");
		//$products = $adapter->fetchAll("SELECT * FROM product");
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('product',$product);
		$view->toHtml();

	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/product/add.php');
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
			$deleteQuery="DELETE FROM `product` WHERE `product`.`product_id` = '$id'";
			$delete=$adapter->delete($deleteQuery);
			if(!$delete)
			{
				throw new Exception("Invelid Request", 1);
			}
			$this->redirect('index.php?c=product&a=grid');
		}
		catch(Exception $e)
		{
			$this->redirect('index.php?c=product&a=grid');	
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