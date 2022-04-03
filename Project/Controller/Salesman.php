<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Salesman extends Controller_Admin_Action
{
	public function __construct()
	{
		if(!$this->authentication())
		{
			$this->redirect('login','admin_login');
		}
	}
	public function indexAction()
	{
		$this->setTitle("Salesman");
		$content = $this->getLayout()->getContent();
		$salesmanIndex = Ccc::getBlock('Salesman_Index');
		$content->addChild($salesmanIndex);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		
		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanGrid
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
		$salesmanModel = Ccc::getModel("Salesman");
		$salesman = $salesmanModel;

		Ccc::register('salesman',$salesman);

		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanEdit
				],
				[
					'element' => '#salesmanMessage',
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
   			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$salesman = $salesmanModel->load($id);
			if(!$salesman)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$this->setTitle('Salesman Edit');
			Ccc::register('salesman',$salesman);

			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $salesmanEdit
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
				$this->gridBlockAction();

		}
		catch(Exception $e)
		{
				$this->gridBlockAction();

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
			$this->gridBlockAction();
		}
		catch(Exception $e)
		{
			$this->gridBlockAction();
		}
	}
}