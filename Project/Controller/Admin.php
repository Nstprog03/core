<?php Ccc::loadClass('Controller_Core_Action');?>
<?php 

class Controller_Admin extends Controller_Core_Action{


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
				throw new Exception("Invelid Request", 1);
				
			}
			$id=$request->getRequest('id');
			$admin_id=$adminModel->load($id)->delete();
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
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
			if(!($admin->adminId))
			{
				unset($admin->adminId);
				$admin->createdAt = date('y-m-d h:m:s');
				$result=$admin->save();
				if(!$result)
				{
					throw new Exception("unable to Updated Record.", 1);
					
				}	
			}
			else
			{

				if(!(int)$admin->adminId)
				{
					throw new Exception("Invelid Request.",1);
				}
				$admin->updatedAt = date('y-m-d h:m:s');
				$result=$admin->save();
				if(!$result)
				{
					throw new Exception("unable to insert Record.", 1);
					
				}
			}
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		} 
		catch (Exception $e) 
		{

			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		}
	}

}


?>