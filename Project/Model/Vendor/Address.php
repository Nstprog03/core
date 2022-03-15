<?php Ccc::loadClass('Model_Core_Row');
class Model_Vendor_Address extends Model_Core_Row
{
	protected $vendor;
	public function __construct()
	{
		$this->setResourceClassName('Vendor_Address_Resource');
		parent::__construct();
	}

	public function setVendor(Mode_Vendor $vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}

	public function getVendor($reload = false)
	{
		$vendorModal = Ccc::getModel('Vendor');
		if(!$this->vendorId){
			return null;
		}
		if($this->vendor && !$reload){
			return $this->vendor;
		}

		$vendor = $vendorModal->fetchRow("SELECT * FROM `vendor` WHERE `vendorId` = {$this->vendorId}");
		if(!$vendor){
			return $vendorModal;
		}
		$this->setVendor($vendor);
		return $this->vendor;
	}
}