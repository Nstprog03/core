<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Salesman_SalesmanCustomer extends Controller_Admin_Action{

    public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }

    public function gridBlockAction()
    {
        
        $customerManageGrid = Ccc::getBlock('Salesman_SalesmanCustomer_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $customerManageGrid
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }
    
	public function gridAction()
	{
        $this->setTitle('Salesman Customer Grid');
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock("Salesman_SalesmanCustomer_Grid");
		$content->addChild($salesmanGrid,'grid');
		
		$this->renderLayout();
	}

    public function saveAction()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        $salesmanId = $request->getRequest('id');
        if($request->isPost())
        {
            $customerData = $request->getPost('customer');
            $customerModel->salesmanId = $salesmanId;
            foreach($customerData as $customer)
            {
                $customerModel->customerId = $customer;
                $result = $customerModel->save(); 

                if(!$result)
                {
                    $this->getMessage()->addMessage("Salesman NOT added",3);
                    throw new Exception("Error Processing Request", 1);
                }
            }
			$this->gridBlockAction();
        }
    }

}

?>