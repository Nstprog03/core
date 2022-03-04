<?php Ccc::loadClass('Controller_Core_Action');
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Vendor_Grid')->toHtml();
	}

	public function addAction()
	{
		$vendorModel = Ccc::getModel('vendor');
		$addressModel = Ccc::getModel('vendor_address');
		Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendorModel,'address'=>$addressModel])->toHtml();
	}
	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$vendorModel = Ccc::getModel('vendor');
			$addressModel = Ccc::getModel('vendor_address');
			$vendor = $vendorModel->load($id);
			if(!$vendor)
			{
				throw new Exception("Unable to fetch Record.", 1);
				
			}
			$address = $addressModel->load($id,'vendorId');
			if(!$address)
			{
				$address = Ccc::getModel('vendor_address');
			}
			Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor,'address'=>$address])->toHtml();

		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		}
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$vendorModel = Ccc::getModel('vendor');
			$vendor = $vendorModel->load($id)->delete();
			if(!$vendor)
			{
				throw new Exception("Unable to delete Record.", 1);
				
			}
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		}

	}
	public function saveVendor()
	{
		$request = $this->getRequest();
		$postData = $request->getPost('vendor');
		if(!$postData)
		{
			throw new Exception("Invalid Request.", 1);
			
		}
		$vendorModel = Ccc::getModel('vendor');
		$vendor = $vendorModel;
		$vendor->setData($postData);
		if(!$vendor->vendorId)
		{
			unset($vendor->vendorId);
			$vendor->createdAt = date('y-m-d h:i:s');
			$insert = $vendor->save();
			if(!$insert)
			{
				throw new Exception("Unable to Save.", 1);
				
			}
			return $insert;
		}
		else
		{
			$vendor->updatedAt = date('y-m-d h:i:s');
			$update = $vendor->save();
			if(!$update)
			{
				throw new Exception("Unable to Save.", 1);
				
			}
			return $vendor->vendorId;
		}
		
	}
	public function saveAddress($vendorId)
	{
		$request = $this->getRequest();
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid Request.", 1);
			
		}
		$addressModel = Ccc::getModel('vendor_address');
		$address = $addressModel;
		$address->setData($postData);
		$address->vendorId=$vendorId;
		if(!$address->addressId)
		{
			unset($address->addressId);
			$insert = $address->save();
			if(!$insert)
			{
				throw new Exception("Unable to Save.", 1);
				
			}
		}
		else
		{
			$update = $address->save();
			if(!$update)
			{
				throw new Exception("Unable to Save.", 1);
				
			}
		}
	
	}

	public function saveAction()
	{
		try
		{
			$vendorId = $this->saveVendor();
			$request = $this->getRequest();
			$postData = $request->getPost('address');
			
			if(!$postData['postalCode'])
			{
				$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
				
			}
			$this->saveAddress($vendorId);
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));

		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		}
	}
}