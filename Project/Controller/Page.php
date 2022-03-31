<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Page extends Controller_Admin_Action
{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
		$this->setTitle('Page Grid');
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid,'grid');	
		$this->renderLayout();
	}
	public function gridContentAction()
	{
		$this->setTitle('Page Grid');
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid,'grid');	
		$this->renderContent();
	}
	public function addAction()
	{
		$this->setTitle('Page Add');
		$pageModel = Ccc::getModel('page');
		$content = $this->getLayout()->getContent();
		$pageAdd = Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel]);
		$content->addChild($pageAdd,'add'); 
		$this->renderContent();
	}
	public function editAction()
	{
		try
		{

			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Request Invelid", 1);
				
			}
			//$postData = $request->getPost('page');
			$pageModel = Ccc::getModel('page');
			$page = $pageModel->load($id);
			if(!$page)
			{
				throw new Exception("Failed to fatch Data", 1);
				
			}
			$this->setTitle('Page Edit');
			$content = $this->getLayout()->getContent();
			$pageEdit = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
			$content->addChild($pageEdit,'edit'); 
			$this->renderContent();
		}
		catch(Exception $e)
		{
			$this->redirect('grid','page',[],true);
		}
	}


	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$postData = $request->getPost('page');
			if(!$postData)
			{
				throw new Exception("Invalid Request", 1);
			}
			$pageModel = Ccc::getModel('page');
			$page = $pageModel;
			$page->setData($postData);
			if(!$page->pageId)
			{
				unset($page->pageId);
				$page->createdAt = date('y-m-d h:i:s');
				
			}
			else
			{

				$page->updatedAt = date('y-m-d h:i:s');
				
			}
			$result=$page->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('unable to save.',3);
				throw new Exception("unable to Save Record.", 1);
				
			}	
			$this->getMessage()->addMessage('Data save succesfully',1);

		}
		catch(Exception $e)
		{
		}
	}

	public function deleteAction()
	{
		try
		{

			$request = $this->getRequest();
			$pageModel = Ccc::getModel('Page');
			$deleteId = $request->getPost('page');
			if($deleteId)
			{
				foreach ($deleteId as $id)
				{
					$delete=$pageModel->load($id)->delete();
					if(!$delete)
					{
						$this->getMessage()->addMessage('unable to delete.',3);
						throw new Exception("Unable to Save", 1);
						
					}
				}
				$this->getMessage()->addMessage('deleted All Data.',1);
				$this->redirect('grid','page',[],true);

			}
			
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Request Invelid", 1);
				
			}
			$pageModel = Ccc::getModel('page');
			$delete = $pageModel->load($id)->delete();
			if(!$delete)
			{
				$this->getMessage()->addMessage('unable to delete.',3);
				throw new Exception("Unable to Save", 1);
				
			}
			$this->getMessage()->addMessage('data deleted succesfully.',1);
			$this->redirect('grid','page',[],true);
		}
		catch(Exception $e)
		{
			$this->redirect('grid','page',[],true);
		}

	}
}