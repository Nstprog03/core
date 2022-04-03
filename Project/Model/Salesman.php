<?php Ccc::loadClass('Model_Core_Row');

class Model_Salesman extends Model_Core_Row
{
	protected $customer;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Salesman_Resource');
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
	public function getCustomer($reload = false)
	{

		$customerModel = Ccc::getModel('Customer');
		if(!$this->customerId)
		{
			return $customerModel;
		}
		if($this->customer && !$reload)
		{
			return $this->customer;
		}
		$customer=$customerModel->fetchRow("SELECT * FROM `customer` WHERE `customerId` = {$this->customerId}");
		if(!$customer)
		{
			return $customerModel;
		}
		$this->setCustomer($customer);

		return $customer;
	}

	public function setCustomer(Model_Customer $customer)
	{
		$this->customer = $customer;
		return $this;
	}	

	public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','customer',['id'=>$this->customerId]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','customer',['id'=>$this->customerId]);
	}

	public function getCustomerUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('grid','salesman_salesmanCustomer',['id'=>$this->customerId]);
	}
}