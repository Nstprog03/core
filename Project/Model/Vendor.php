<?php Ccc::loadClass('Model_Core_Row');
class Model_Vendor extends Model_Core_Row
{
	protected $address;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Vendor_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses)) {
			return $statuses[$key];
		}
		return self::STATUS_DEFAULT;
	}
	public function getAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Vendor_Address'); 
		if(!$this->vendorId)
		{
			return $addressModel;
		}
		if($this->address && !$reload)
		{
			return $this->address;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `vendor_address` WHERE `vendorId` = {$this->vendorId}");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setAddress($address);

		return $this->address;
	}
	public function setAddress(Model_Vendor_Address $address)
	{
		$this->address =$address;
		return $this;
	}
}