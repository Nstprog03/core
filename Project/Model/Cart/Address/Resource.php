<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Cart_Address_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('cart_address')->setPrimaryKey('addressId');
		parent::__construct();
	}

}


?>