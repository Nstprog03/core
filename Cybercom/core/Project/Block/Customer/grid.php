<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Customer_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}
	public function getCustomers()
	{
		$customerModel = Ccc::getModel('Customer');
		$customers = $customerModel->fetchAll("SELECT * FROM customer");
		return $customers;	

	}
	public function getAddresses()
	{
		$addressModel = Ccc::getModel('Customer_Address');
		$addresses = $addressModel->fetchAll("SELECT * FROM address");
		return $addresses;	

	}
}


?>