<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Salesman_SalesmanCustomer extends Controller_Core_Action{

	public function gridAction()
	{

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
			$this->redirect('grid','Salesman_SalesmanCustomer');
        }
    }

}

?>