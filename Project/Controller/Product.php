<?php Ccc::loadClass('Controller_Admin_Action');


class Controller_Product extends Controller_Admin_Action{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
		$this->setTitle('Product Grid');
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Grid');
		$content->addChild($productGrid,'grid');	
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Product Add');
		$productModel = Ccc::getModel('product');
		$content = $this->getLayout()->getContent();
		$productAdd = Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel]);
		$content->addChild($productAdd,'add'); 
		$this->renderLayout();
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
			$product = $productModel->load($id);
			if(!$product)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$this->setTitle('Product Edit');
			$content = $this->getLayout()->getContent();
			$productEdit = Ccc::getBlock('Product_Edit')->setData(['product'=>$product]);
			$content->addChild($productEdit,'edit'); 
			$this->renderLayout();	
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);
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
			$medias = $productModel->fetchAll("SELECT name FROM product_media WHERE  productId='$productId'");
			foreach ($medias as $media)
			{
				unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
			}
			$result = $productModel->load($productId)->delete();
			if(!$result)
			{
				$this->getMessage()->addMessage('unable to delete.',3);
				throw new Exception("Unable to Delet Record.", 1);
				
			}
			$this->getMessage()->addMessage('data deleted succesfully.',1);
		    $this->redirect('grid','product',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','product',[],true);
		}		
	}
	public function saveAction()
	{
		try
		{
			
			$request=$this->getRequest();
			$productModel= Ccc::getModel('Product');
			$categoryIds = $request->getPost('category');
			if(!$request->isPost())
			{
				throw new Exception("Request Invalid.",1);
			}
			$postData=$request->getPost('product');
			if(!$postData)
			{
				throw new Exception("Invalid data Posted.", 1);
				
			}
			$product=$productModel;
			$product->setData($postData);
			if(!($product->productId))
			{
				unset($product->productId);

				$product->createdAt = date('y-m-d h:m:s');
				
			}
			else
			{


				if(!(int)$product->productId)
				{
					throw new Exception("Invelid Request.",1);
				}
				$product->updatedAt = date('y-m-d h:m:s');
			}
			$result=$product->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('unable to inserted.',3);
				throw new Exception("unable to Updated Record.", 1);
				
			}
			if(!$categoryIds)
			{
				$categoryIds['exists'] = []; 
			}
			$product->saveCategories($categoryIds);
			$this->redirect('grid','product',[],true);
		} 
		catch (Exception $e) 
		{

			$this->redirect('grid','product',[],true);
		}
	}

}


?>