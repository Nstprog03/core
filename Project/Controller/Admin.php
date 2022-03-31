<?php Ccc::loadClass('Controller_Admin_Action');?>
<?php 

class Controller_Admin extends Controller_Admin_Action{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function indexAction()
	{
		$this->setTitle("Admin");
		$content = $this->getLayout()->getContent();
		$adminIndex = Ccc::getBlock('Admin_Index');
		$content->addChild($adminIndex);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		
		$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminGrid
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
		$adminModel = Ccc::getModel("Admin");
		$admin = $adminModel;
		$address = $adminModel;

		Ccc::register('admin',$admin);

		$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminEdit
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->renderJson($response);
		
	}

	// public function gridAction()
	// {
	// 	$this->setTitle('Admin Grid');	
	// 	$content = $this->getLayout()->getContent();
	// 	$adminGrid = Ccc::getBlock('Admin_Grid');
	// 	$content->addChild($adminGrid,'grid');	
	// 	$this->renderLayout();
	
	// }
	// public function addAction()
	// {
	// 	$this->setTitle('Admin Add');
	// 	$adminModel = Ccc::getModel('admin');
	// 	$content = $this->getLayout()->getContent();
	// 	$adminAdd = Ccc::getBlock('Admin_Edit');
	// 	Ccc::register('admin',$adminModel);
	// 	$content->addChild($adminAdd,'add');
	// 	$this->renderContent();
	// }
	public function editBlockAction()
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
			$this->setTitle('Admin Edit');
			Ccc::register('admin',$admin);

			$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminEdit
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
			$adminId=$adminModel->load($id)->delete();
			$this->getMessage()->addMessage('data deleted succesfully.',1);
			$this->gridBlockAction();

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			$this->gridBlockAction();
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
			}
			else
			{

				unset($admin->password);
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
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->gridBlockAction();
		}
	}

}


?>