<?php Ccc::loadClass('Model_Core_Row_Resource');
class Model_Product_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('product')->setPrimaryKey('productId');
		parent::__construct();
	}
}