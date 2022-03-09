<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$content->addChild($salesmanGrid,'grid');	
		$this->renderLayout();
	}
	public function addAction()
	{
		$salesmanModel = Ccc::getModel('salesman');
		$content = $this->getLayout()->getContent();
		$salesmanAdd = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmanModel]);
		$content->addChild($salesmanAdd,'add'); 
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
			$salesmenModel = Ccc::getModel('salesman');
			$salesmen = $salesmenModel->load($id);
			if(!$salesmen)
			{
				throw new Exception("unable to fatch Record.", 1);
			}
			$content = $this->getLayout()->getContent();
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmen]);
			$content->addChild($salesmanEdit,'edit'); 
			$this->renderLayout();
		}
		catch(Exception $e)
		{
			$this->redirect('grid','salesman',[],true);
		}
	}
	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$postData = $request->getPost('salesman');
			if(!$postData)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$salesmenModel = Ccc::getModel('salesman');
			$salesmen = $salesmenModel;
			$salesmen->setData($postData);
			if(!$salesmen->salesmanId)
			{
				unset($salesmen->salesmanId);
				$salesmen->createdAt = date("Y-m-d h:i:s");
			}
			else
			{
				$salesmen->updatedAt = date("Y-m-d h:i:s");

			}
			$insert = $salesmen->save();
			if(!$insert)
			{
				$this->getMessage()->addMessage('unable to insert Salesman.',3);
				throw new Exception("Unable to Save Record.", 1);
				
			}
			$this->getMessage()->addMessage('Salesman Inserted succesfully.',1); 
			$this->redirect('grid','salesman',[],true);
		}
		catch(Exception $e)
		{
			$this->redirect('grid','salesman',[],true);	
		}
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$salesmenModel = Ccc::getModel('salesman');
			$customerPriceModel = Ccc::getModel('Customer_Price');
			$customerModel = Ccc::getModel('Customer');
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmanId` = {$salesmanId}");
			foreach($customers as $customer)
			{
				$customerPrices = $customerPriceModel->fetchAll("SELECT `entityId` FROM `customer_price` WHERE `customerId` = {$customer->customerId}");
				foreach ($customerPrices as $customerPrice) 
				{
					$customerPriceModel->load($customerPrice->entityId)->delete();
				}
			}
			$delete = $salesmenModel->load($id)->delete();
			if(!$delete)
			{
				$this->getMessage()->addMessage('unable to delete.',3);
				throw new Exception("unable to fatch Record.", 1);
			}
			$this->getMessage()->addMessage('deleted succesfully.',1);
			$this->redirect('grid','salesman',[],true);
		}
		catch(Exception $e)
		{
			$this->redirect('grid','salesman',[],true);
		}
	}
}