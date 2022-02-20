<?php Ccc::loadClass('Controller_Core_Action');
	Ccc::loadClass('Model_Admin');
	Ccc::loadClass('Model_Core_Request');


?>
<?php 

class Controller_Admin extends Controller_Core_Action{


	public function gridAction()
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
	}
	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
	}
	public function editAction()
	{
		try 
   		{
   			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$admin = $adminModel->fetchRow("SELECT * FROM admin WHERE admin_id = {$id}");
			if(!$admin)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();
   		}	 
   		catch (Exception $e) 
   		{
   			throw new Exception("Invalid Request.", 1);
   		}
   	}


	public function deleteAction()
	{
		
		try
		{
			$adminModel = Ccc::getModel('Admin');
			$request=$this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invelid Request", 1);
				
			}
			$id=$request->getRequest('id');
			$admin_id=$adminModel->delete($id);
			//$this->redirect('index.php?c=admin&a=grid');
			$this->redirect($this->getView()->getUrl('admin','grid',[],true));

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			$this->redirect($this->getView()->getUrl('admin','grid'));
		}
	}
	public function saveAction()
	{
		try
		{
			
			$request=$this->getRequest();
			$adminModel= Ccc::getModel('Admin');
			if(!$request->isPost())
			{
				throw new Exception("Request Invalid.",1);
			}

			$adapter=new Adapter();
			$postData=$request->getPost('admin');
			if(!$postData)
			{
				throw new Exception("Invalid data Posted.", 1);
				
			}
			if(array_key_exists('admin_id',$postData))
			{
				$admin_id=$postData['admin_id'];
				if(!(int)$postData['admin_id'])
				{
					throw new Exception("Invelid Request.",1);
				}
				$postData['updated_date'] = date('y-m-d h:m:s');

				$admin_id=$adminModel->update($postData,$admin_id);
				
			}
			else
			{
				$postData['created_date'] = date('y-m-d h:m:s');

				$admin_id=$adminModel->insert($postData);

			}

			$this->redirect($this->getView()->getUrl('admin','grid'));
		} 
		
		catch (Exception $e) 
		{

			$this->redirect($this->getView()->getUrl('admin','grid'));
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