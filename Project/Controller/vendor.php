<?php Ccc::loadClass('Controller_Admin_Action');
class Controller_Vendor extends Controller_Admin_Action
{
	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
		$this->setTitle('Vendor Grid');
	
		$content = $this->getLayout()->getContent();
		$vendorGrid = Ccc::getBlock('Vendor_Grid');
		$content->addChild($vendorGrid,'grid');	
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Vendor Add');
		$vendorModel = Ccc::getModel('vendor');
		$addressModel = Ccc::getModel('vendor_address');
		$content = $this->getLayout()->getContent();
		$vendorAdd = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendorModel,'address'=>$addressModel]);
		$content->addChild($vendorAdd,'add'); 
		$this->renderLayout();
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
			$content = $this->getLayout()->getContent();
			$this->setTitle('Vendor Edit');
			$vendorEdit = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor,'address'=>$address]);
			$content->addChild($vendorEdit,'edit'); 
			$this->renderLayout();

		}
		catch(Exception $e)
		{
			$this->redirect('grid','vendor',[],true);
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
				$this->getMessage()->addMessage('unable to delete.',3);
				throw new Exception("Unable to delete Record.", 1);
				
			}
			$this->getMessage()->addMessage('deleted succesfully.',1);
			$this->redirect('grid','vendor',[],true);
		}
		catch(Exception $e)
		{
			$this->redirect('grid','vendor',[],true);
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
		}
		else
		{
			$vendor->updatedAt = date('y-m-d h:i:s');
			$update = $vendor->save();
		}
		$save = $vendor->save();
		if(!$save)
		{
			$this->getMessage()->addMessage('unable to save Vendor.',3);
			throw new Exception("Unable to Save.", 1);
			
		}
		$this->getMessage()->addMessage('data inserted succesfully.',1);
		return $save; 
		
	}
	public function saveAddress($vendor)
	{
		$request = $this->getRequest();
		$address = $vendor->getAddress();
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid Request.", 1);
			
		}
		if(!$address->addressId)
		{
			unset($address->addressId);
		}
		$address->setData($postData);
		$address->vendorId=$vendor->vendorId;
		
		$save = $address->save();
		if(!$save->addressId)
		{
			$this->getMessage()->addMessage('Address Inserted succesfully.',1);
			throw new Exception("Unable to Save.", 1);
			
		}
	
	}

	public function saveAction()
	{	
		try
		{
			$vendor = $this->saveVendor();
			
			
			$this->saveAddress($vendor);
			$this->redirect('grid','vendor',[],true);

		}
		catch(Exception $e)
		{
			$this->redirect('grid','vendor',[],true);
		}
	}
}