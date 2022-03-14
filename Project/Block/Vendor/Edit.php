<?php Ccc::loadClass('Block_Core_Template');
class Block_Vendor_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/edit.php');
	}
	public function getVendor()
	{
		return $this->getData('vendor');
	}
	public function getaddress()
	{
		return $this->getData('address');
	}
}