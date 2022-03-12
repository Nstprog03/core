<?php Ccc::loadClass('Controller_Admin_Action');?>
<?php 

class Controller_Admin extends Controller_Admin_Action{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
			
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'grid');	
		$this->renderLayout();
	
	}
	public function addAction()
	{
		$adminModel = Ccc::getModel('admin');
		$content = $this->getLayout()->getContent();
		$adminAdd = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$adminModel]);
		$content->addChild($adminAdd,'add'); 
		$this->renderLayout();
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
			$admin = $adminModel->load($id);
			if(!$admin)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$content = $this->getLayout()->getContent();
			$adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
			$content->addChild($adminEdit,'edit'); 
			$this->renderLayout();
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
				$this->getMessage()->addMessage('unable to delete.',3);
				throw new Exception("Invelid Request", 1);
				
			}
			$id=$request->getRequest('id');
			$admin_id=$adminModel->load($id)->delete();
			$this->getMessage()->addMessage('data deleted succesfully.',1);
			$this->redirect('grid','admin',[],true);

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			$this->redirect('grid','admin',[],true);
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
			$postData=$request->getPost('admin');
			if(!$postData)
			{
				throw new Exception("Invalid data Posted.", 1);
				
			}
			$admin=$adminModel;
			$admin->setData($postData);
			$admin->password = md5($postData['password']);
			if(!($admin->adminId))
			{
				unset($admin->adminId);
				$admin->createdAt = date('y-m-d h:m:s');
			}
			else
			{

				if(!(int)$admin->adminId)
				{
					throw new Exception("Invelid Request.",1);
				}
				$admin->updatedAt = date('y-m-d h:m:s');
			}
			$result=$admin->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('unable to inserted.',3);
				throw new Exception("unable to save Record.", 1);
				
			}	
			$this->getMessage()->addMessage('Data save succesfully',1);
			$this->redirect('grid','admin',[],true);
		} 
		catch (Exception $e) 
		{

			$this->redirect('grid','admin',[],true);
		}
	}

}


?>