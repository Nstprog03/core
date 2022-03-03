<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		
		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$content->addChild($customerGrid,'grid');	
		$this->renderLayout();
	}

	public function addAction()
	{
		$customerModel = Ccc::getModel('customer');
		$addressModel = Ccc::getModel('customer_address');
		$content = $this->getLayout()->getContent();
		$customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'address'=>$addressModel]);
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
		$addressModel = Ccc::getModel('Customer_Address');
		$address = $addressModel->load($id,'customerId');
		if(!$address)
		{
			$address = Ccc::getModel('Customer_Address');	
		}
		$content = $this->getLayout()->getContent();
		$customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customer,'address'=>$address]);
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
				throw new Exception("Unable to Delet Record.", 1);
				
			}
			$this->redirect($this->getView()->getUrl('grid','customer',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','customer',[],true));
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
			$insert = $customer->save();
			if(!$insert)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			return $insert;
		}
		else
		{
			
			$customer->updatedAt = date('y-m-d h:i:s');
			$update = $customer->save();
			return $customer->customerId;
		}
		 
	}
	protected function saveAddress($customerId)
	{

		$request = $this->getRequest();
		if(!$request->getPost('address'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}
		$addressModel = Ccc::getModel('Customer_Address');
		$address = $addressModel;
		$address->setData($postData);
		$address->customerId = $customerId;
		if(!$address->addressId)
		{	
			unset($address->addressId);
			$insert = $address->save();
			if(!$insert)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
		}
		else
		{
			$address->billing = (!array_key_exists('billing',$postData))?2:1;
			$address->shipping = (!array_key_exists('shipping',$postData))?2:1;
			$update = $address->save();
			if(!$update)
			{
				throw new Exception("System is unable to Update.", 1);
			}
		}
	}

	public function saveAction()
	{
		try
		{
			$customerId=$this->saveCustomer();
			$request = $this->getRequest();
			$postData = $request->getPost('address');		
			if(!$postData['postalCode'])
			{
				$this->redirect($this->getView()->getUrl('grid','customer',[],true));
			}

			$this->saveAddress($customerId);

			$this->redirect($this->getView()->getUrl('grid','customer',[],true));
		}
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','customer',[],true));
		}
	}

}

?>