<?php Ccc::loadClass('Model_Core_Table');

class Model_Product extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('product')->setPrimaryKey('product_id');
	}

}





	?>