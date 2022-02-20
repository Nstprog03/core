<?php
Ccc::loadClass('Block_Core_Template');
class Block_Customer_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/customer/edit.php');
	}
	
	public function getCustomer()
   	{
   		return $this->getData('customer');
   	}
   	public function getAddress()
   	{
   		return $this->getData('address');
   	}
}
?>