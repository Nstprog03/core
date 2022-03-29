<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php

class Controller_Customer extends Controller_Admin_Action{
	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
		$this->setTitle('Customer Grid');
		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$content->addChild($customerGrid,'grid');	
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Customer Add');
		$customerModel = Ccc::getModel('customer');
		$billingAddress = $customerModel->getBillingAddress();
		$shippingAddress = $customerModel->getShippingAddress();
		$content = $this->getLayout()->getContent();
		$customerAdd = Ccc::getBlock('Customer_Edit');
		Ccc::register('customer',$customerModel);
		Ccc::register('billingAddress',$billingAddress);
		Ccc::register('shippingAddress',$shippingAddress);
		$content->addChild($customerAdd,'add'); 
		$this->renderLayout();
	}

	public function editAction()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		$id = (int)$request->getRequest('id');
		
		if(!$id)
		{
			throw new Exception("Invalid Request", 1);
		}
		
		$customer=$customerModel->load($id);
		
		if(!$customer)
		{	
			throw new Exception("System is unable to find record.", 1);	
		}

		$this->setTitle('Customer Edit');
		$content = $this->getLayout()->getContent();
		$customerEdit = Ccc::getBlock('Customer_Edit');
		Ccc::register('customer',$customer);
		Ccc::register('billingAddress',$customer->getBillingAddress());
		Ccc::register('shippingAddress',$customer->getShippingAddress());
		$content->addChild($customerEdit,'edit'); 
		$this->renderLayout();
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
			$this->redirect('grid','customer',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','customer',[],true);
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
		$message = $this->getMessage()->addMessage('Customer Inserted succesfully.',1);
		echo $message->getMessages()['Success'];
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

			//$this->redirect('grid','customer',[],true);
		}
		catch (Exception $e) 
		{
			$message = $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				echo $message->getMessages()['error'];
		}
	}

}

?>