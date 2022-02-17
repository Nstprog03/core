<?php Ccc::loadClass('Controller_Core_Action');
		Ccc::loadClass('Model_Admin');
		Ccc::loadClass('Model_Core_Request');


?>
<?php $c = new Ccc();

class Controller_Admin extends Controller_Core_Action{


	public function gridAction()
	{
		
		$adminModel = Ccc::getModel('Admin');
		$admins=$adminModel->fetchAll();
		$view = $this->getView();
		$view->setTemplate('view/admin/grid.php');
		$view->addData('admins',$admins);
		$view->toHtml();
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/admin/add.php');
		$view->toHtml();
	}

	public function editAction()
	{
		try
		{
			$adminModel = Ccc::getModel('Admin');
			$request=$this->getRequest();
			$id=$request->getRequest('id');

			if(!$id)
			{

				throw new Exception("Invelid Request", 1);
				
			}
			$admin=$adminModel->fetchRow($id);
			$view = $this->getView();
			$view->setTemplate('view/admin/edit.php');
			$view->addData('admin',$admin);
			$view->toHtml();

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
			$adminModel = Ccc::getModel('Admin');
			$request=$this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invelid Request", 1);
				
			}
			$id=$request->getRequest('id');
			$admin_id=$adminModel->delete($id);
			//$this->redirect('index.php?c=admin&a=grid');
			$this->redirect($this->getUrl('admin','grid'));

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			$this->redirect($this->getUrl('admin','grid'));
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

			$this->redirect($this->getUrl('admin','grid'));
		} 
		
		catch (Exception $e) 
		{

			$this->redirect($this->getUrl('admin','grid'));
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