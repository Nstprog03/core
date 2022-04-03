<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Page extends Controller_Admin_Action
{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	
	public function indexAction()
	{
		$this->setTitle("Page");
		$content = $this->getLayout()->getContent();
		$pageIndex = Ccc::getBlock('Page_Index');
		$content->addChild($pageIndex);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		
		$pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->renderJson($response);
	}
	public function addBlockAction()
	{
		$pageModel = Ccc::getModel("Page");
		$page = $pageModel;
		$address = $pageModel;

		Ccc::register('page',$page);

		$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageEdit
				],
				[
					'element' => '#pageMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->renderJson($response);
		
	}
	public function editBlockAction()
	{
		try 
   		{
   			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$page = $pageModel->load($id);
			if(!$page)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$this->setTitle('Page Edit');
			Ccc::register('page',$page);

			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $pageEdit
					],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->renderJson($response);
   		}	 
   		catch (Exception $e) 
   		{
   			throw new Exception("Invalid Request.", 1);
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
			$this->gridBlockAction();

		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('Invalid Request',3);
			$this->gridBlockAction();

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
			$this->gridBlockAction();

		}
		catch(Exception $e)
		{
			$this->getMessage()->addMessage('data not deleted.',3);
			$this->gridBlockAction();

		}

	}
}