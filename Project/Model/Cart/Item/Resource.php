<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Cart_Item_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('cart_item')->setPrimaryKey('itemId');
		parent::__construct();
	}

}


?>