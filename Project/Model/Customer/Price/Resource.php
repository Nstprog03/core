<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Customer_Price_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('customer_price')->setPrimaryKey('entityId');
		parent::__construct();
	}

}


?>