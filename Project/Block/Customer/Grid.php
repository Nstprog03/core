<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Customer_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}
	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
		$customerModel = Ccc::getModel('Customer');
		$totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(customerId) FROM `customer`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
		return $customers;

	}
	public function getAddresses()
	{
		$addressModel = Ccc::getModel('Customer_Address');
		$addresses = $addressModel->fetchAll("SELECT * FROM customer_address");
		return $addresses;	

	}
}


?>