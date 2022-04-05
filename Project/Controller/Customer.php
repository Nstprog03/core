<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php

class Controller_Customer extends Controller_Admin_Action{
	

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}


	public function indexAction()
	{
		$this->setTitle("Customer");
		$content = $this->getLayout()->getContent();
		$adminIndex = Ccc::getBlock('Customer_Index');
		$content->addChild($adminIndex);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		
		$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerGrid
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
		$customerModel = Ccc::getModel("Customer");
		$customer = $customerModel;
		$address = $customerModel;

		Ccc::register('customer',$customer);
		Ccc::register('billingAddress',$address);
		Ccc::register('shippingAddress',$address);

		$customerEdit = Ccc::getBlock('Customer_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerEdit
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
			$customerModel = Ccc::getModel("Customer");
			$addressModel = Ccc::getModel("Customer_Address");
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			if(!$customerId)
			{
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$customerId)
			{
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$customer = $customerModel->load($customerId);
			$billingAddress = $customer->getBillingAddress();
			$shippingAddress = $customer->getShippingAddress();
			if(!$customer)
			{
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('customer',$customer);
			Ccc::register('billingAddress',$billingAddress);
			Ccc::register('shippingAddress',$shippingAddress);

			$customerEdit = Ccc::getBlock('Customer_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $customerEdit
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
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$customerId = $request->getRequest('id');
			if(!$customerId)
			{

				throw new Exception("Unable to fetch ID.", 1);
				
			}
			$result = $customerModel->load($customerId)->delete();
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

	protected function saveCustomer()
	{
		
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->getPost('customer'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('customer');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}
		$customer = $customerModel;
		$customer->setData($postData);
		if(!$customer->customerId)
		{
			unset($customer->customerId);
			$customer->createdAt = date('y-m-d h:m:s');
		}
		else
		{
			$customer->updatedAt = date('y-m-d h:i:s');
		}
		$save = $customer->save();
		if(!$save->customerId)
		{
			$this->getMessage()->addMessage('unable to insert Customer.',3);
			throw new Exception("System is unable to Insert.", 1);
		}
			$this->getMessage()->addMessage('Customer Inserted succesfully.',1);
		return $save;
		 
	}
	protected function saveAddress($customer = null)
	{
		if(!$customer)
		{
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				$this->getMessage()->addMessage('pela Customer nakh p6i aay aaya.',3);
				throw new Exception("System is unable to Save Address without Customer.", 1);
			}
			$customer = Ccc::getModel('customer')->load($customerId);
		}
		$request = $this->getRequest();
		if(!$request->getPost())
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postBilling = $request->getPost('billingAddress');
		$postShipping = $request->getPost('shippingAddress');
		
		$billing = $customer->getBillingAddress();
		$shipping = $customer->getShippingAddress();
		if(!$billing->addressId)
		{
			unset($billing->addressId);
		}
		if(!$shipping->addressId)
		{
			unset($shipping->addressId);
		}
		if($postBilling)
		{
			$billing->setData($postBilling);
		}
		else
		{	
			//$billing = Ccc::getModel('customer_address');
			$billing->billing = 1;
			$billing->shipping = 2;
		}
		$billing->customerId = $customer->customerId;
		if($postShipping)
		{
			$shipping->setData($postShipping);
		}
		else
		{
			//$shipping = setData(Ccc::getModel('customer_address'));
			$shipping->shipping = 1;
			$shipping->billing = 2;
		}	
		$shipping->customerId = $customer->customerId;
		
		
		$save = $billing->save();
		if(!$save)
		{
			$this->getMessage()->addMessage('Customer Details Not Saved.',3);
			throw new Exception("System is unable to Save.", 1);
		}
		$save = $shipping->save();
		if(!$save)
		{
			$this->getMessage()->addMessage('Customer Details Not Saved.',3);
			throw new Exception("System is unable to Save.", 1);
		}
	}

	public function saveAction()
	{
		try
		{
			if($this->getRequest()->getPost('customer'))
			{
				$customer=$this->saveCustomer();
				if(!$customer)
				{
					$this->getMessage()->addMessage('Customer Details Not Saved.',3);
					throw new Exception("System is unable to Save.", 1);
				}

				$this->saveAddress($customer);

			}
			if ($this->getRequest()->getPost('billingAddress') || $this->getRequest()->getPost('shippingAddress'))
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