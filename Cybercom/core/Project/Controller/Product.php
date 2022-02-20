<?php Ccc::loadClass('Controller_Core_Action');
		Ccc::loadClass('Model_Product');
		Ccc::loadClass('Model_Core_Request');


?>
<?php $c = new Ccc();

class Controller_Product extends Controller_Core_Action{


	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
	}

	public function editAction()
	{
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$product = $productModel->fetchRow("SELECT * FROM product WHERE product_id = {$id}");
			if(!$product)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			
			Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();	
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);
		}
		catch(Exception $e)
		{
			throw new Exception("Invelid Request", 1);
		}
		
	}

	public function deleteAction()
	{
		
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$productId = $request->getRequest('id');
			if(!$productId)
			{
				throw new Exception("Unable to fetch ID.", 1);
				
			}
			
			$result = $productModel->delete($productId);
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
				
			}
		    $this->redirect($this->getView()->getUrl('product','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
		}		
	}
	public function saveAction()
	{
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			if(!$request->getPost('product'))
			{
				throw new Exception("Invalid Request", 1);
			}	
			$postData = $request->getPost('product');
			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
			}

			if (array_key_exists('product_id',$postData))
			{
				if(!(int)$postData['product_id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$product_id = $postData["product_id"];
				$postData['updated_date']  = date('Y-m-d H:m:s');
				$update = $productModel->update($postData,$product_id);
				if(!$update)
				{
					throw new Exception("System is unable to Update.", 1);
				}
			}
			else
			{
				$postData['created_date'] = date('Y-m-d H:m:s');
				$insert = $productModel->insert($postData);
				if(!$insert)
				{
					throw new Exception("System is unable to Insert.", 1);
				}
			}
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
		}
	}

}


?>