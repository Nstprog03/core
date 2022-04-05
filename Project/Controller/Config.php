<?php Ccc::loadClass('Controller_Admin_Action');?>
<?php 

class Controller_Config extends Controller_Admin_Action{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	public function indexAction()
	{
		$this->setTitle("Config");
		$content = $this->getLayout()->getContent();
		$configIndex = Ccc::getBlock('Config_Index');
		$content->addChild($configIndex);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configGrid
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
		$configModel = Ccc::getModel("Config");
		$config = $configModel;
		$address = $configModel;

		Ccc::register('config',$config);

		$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configEdit
				],
				[
					'element' => '#configMessage',
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
   			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$config = $configModel->load($id);
			if(!$config)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$this->setTitle('Config Edit');
			Ccc::register('config',$config);

			$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configEdit
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
			$configModel = Ccc::getModel('Config');
			$request=$this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invelid Request", 1);
				
			}
			$id=$request->getRequest('id');
			$config_id=$configModel->load($id)->delete();
			$this->getMessage()->addMessage('deleted succesfully.',1);
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
			$configModel= Ccc::getModel('Config');
			if(!$request->isPost())
			{
				throw new Exception("Request Invalid.",1);
			}
			$postData=$request->getPost('config');
			if(!$postData)
			{
				throw new Exception("Invalid data Posted.", 1);
				
			}
			$config=$configModel;
			$config->setData($postData);
			if(!($config->configId))
			{
				unset($config->configId);
				$config->createdAt = date('y-m-d h:m:s');
			}
			else
			{

				if(!(int)$config->configId)
				{
					throw new Exception("Invelid Request.",1);
				}
			}
			$result=$config->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('unable to save.',3);
				throw new Exception("unable to Save Record.", 1);
				
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