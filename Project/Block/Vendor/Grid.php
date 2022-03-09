<?php Ccc::loadClass('Block_Core_Template');

class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}
	public function getVendors()
	{
		$vendorModel = Ccc::getModel('vendor');
		$vendors = $vendorModel->fetchAll("SELECT * FROM `vendor`");
		return $vendors;
	}
	public function getAddresses()
	{
		$addressModel = Ccc::getModel('vendor_address');
		$addresses = $addressModel->fetchAll("SELECT * FROM `vendor_address`");
		return $addresses;
	}
}