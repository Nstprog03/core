<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		$customerModel = Ccc::getModel('Customer');	
		$addressModel = Ccc::getModel('Customer_Address');	
		Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'address'=>$addressModel])->toHtml();
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
			$address = ['address' => null,
						 'postalCode' => null,'city' => null, 'state' => null, 'country' => null, 'billingAddress' => 2, 'shippingAddress'=>2, 'customerId' => $customer['customerId']];	
		}
		Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address)->toHtml();
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
		if($customer->customerId==null)
		{
			unset($customer->customerId);
			$customer->createdAt = date('y-m-d h:m:s');
			$insert = $customer->save();
			if($insert==null)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			return $insert;
		}
		else
		{
			if(!(int)$customer->customerId)
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customer->updatedAt = date('y-m-d h:i:s');
			$update = $customer->save();
		}
		 
	}
	protected function saveAddress($customerId)
	{

		$addressModel = Ccc::getModel('Customer_Address');
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
		$address = $addressModel;
		$address->setData($postData);
		//$address->getStatus($address->billing)
		if($address->addressId == null)
		{	
			$address->customerId = $customerId;
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
			if(!$request->getPost('address'))
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