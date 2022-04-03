<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php

class Controller_Vendor extends Controller_Admin_Action{
	

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}


	public function indexAction()
	{
		$this->setTitle("Vendor");
		$content = $this->getLayout()->getContent();
		$vendorIndex = Ccc::getBlock('Vendor_Index');
		$content->addChild($vendorIndex);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorGrid
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
		$vendorModel = Ccc::getModel("Vendor");
		$vendor = $vendorModel;
		$address = $vendorModel;

		Ccc::register('vendor',$vendor);
		Ccc::register('address',$address);

		$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorEdit
				],
				[
					'element' => '#adminMessage',
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
			$vendorModel = Ccc::getModel("Vendor");
			$addressModel = Ccc::getModel("Vendor_Address");
			$request = $this->getRequest();
			$vendorId = $request->getRequest('id');
			if(!$vendorId)
			{
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$vendorId)
			{
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$vendor = $vendorModel->load($vendorId);
			$address = $vendor->getAddress();
			if(!$vendor)
			{
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('vendor',$vendor);
			Ccc::register('address',$address);

			$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $vendorEdit
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
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}	
	}
	

	public function deleteAction()
	{
		try 
		{
			$vendorModel = Ccc::getModel('Vendor');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$vendorId = $request->getRequest('id');
			if(!$vendorId)
			{

				throw new Exception("Unable to fetch ID.", 1);
				
			}
			$result = $vendorModel->load($vendorId)->delete();
			if(!$result)
			{
				$this->getMessage()->addMessage('unable to delete.',3);
				throw new Exception("Unable to Delet Record.", 1);
				
			}
			$this->getMessage()->addMessage('deleted succesfully.',1);
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->gridBlockAction();
		}		
	}

	protected function saveVendor()
	{
		
		$vendorModel = Ccc::getModel('Vendor');
		$request = $this->getRequest();
		if(!$request->getPost('vendor'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('vendor');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}
		$vendor = $vendorModel;
		$vendor->setData($postData);
		if(!$vendor->vendorId)
		{
			unset($vendor->vendorId);
			$vendor->createdAt = date('y-m-d h:m:s');
		}
		else
		{
			$vendor->updatedAt = date('y-m-d h:i:s');
		}
		$save = $vendor->save();
		if(!$save->vendorId)
		{
			$this->getMessage()->addMessage('unable to insert Vendor.',3);
			throw new Exception("System is unable to Insert.", 1);
		}
			$this->getMessage()->addMessage('Vendor Inserted succesfully.',1);
		return $save;
		 
	}
	protected function saveAddress($vendor = null)
	{
		if(!$vendor)
		{
			$vendorId = $this->getRequest()->getRequest('id');
			if(!$vendorId)
			{
				$this->getMessage()->addMessage('pela Vendor nakh p6i aay aaya.',3);
				throw new Exception("System is unable to Save Address without Vendor.", 1);
			}
			$vendor = Ccc::getModel('vendor')->load($vendorId);
		}
		$request = $this->getRequest();
		if(!$request->getPost())
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postAddress = $request->getPost('address');
		
		$address = $vendor->getAddress();
		if(!$address->addressId)
		{
			unset($address->addressId);
		}
		if($postAddress)
		{
			$address->setData($postAddress);
		}
		$address->vendorId = $vendor->vendorId;
		
		
		$save = $address->save();
		if(!$save)
		{
			$this->getMessage()->addMessage('Vendor Details Not Saved.',3);
			throw new Exception("System is unable to Save.", 1);
		}
	}

	public function saveAction()
	{
		try
		{
			if($this->getRequest()->getPost('vendor'))
			{
				$vendor=$this->saveVendor();
				if(!$vendor)
				{
					$this->getMessage()->addMessage('Vendor Details Not Saved.',3);
					throw new Exception("System is unable to Save.", 1);
				}

				$this->saveAddress($vendor);

			}
			if ($this->getRequest()->getPost('address'))
			{
				$this->saveAddress();
			}
			$this->gridBlockAction();
		}
		catch (Exception $e)
		{
			$message = $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}
	}
	
}

?>