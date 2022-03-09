<?php Ccc::loadClass('Controller_Core_Action');?>
<?php 

class Controller_Config extends Controller_Core_Action{


	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Grid');
		$content->addChild($configGrid,'grid');	
		$this->renderLayout();
	}
	public function addAction()
	{
		$configModel = Ccc::getModel('config');
		$content = $this->getLayout()->getContent();
		$configAdd = Ccc::getBlock('Config_Edit')->setData(['config'=>$configModel]);
		$content->addChild($configAdd,'add'); 
		$this->renderLayout();
	}
	public function editAction()
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
			$content = $this->getLayout()->getContent();
			$configEdit = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
			$content->addChild($configEdit,'edit'); 
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
			$configModel = Ccc::getModel('Config');
			$request=$this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invelid Request", 1);
				
			}
			$id=$request->getRequest('id');
			$config_id=$configModel->load($id)->delete();
			$this->getMessage()->addMessage('deleted succesfully.',1);
			$this->redirect('grid','config',[],true);

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			$this->redirect('grid','config',[],true);
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
			$this->redirect('grid','config',[],true);
		} 
		catch (Exception $e) 
		{

			$this->redirect('grid','config',[],true);
		}
	}

}


?>