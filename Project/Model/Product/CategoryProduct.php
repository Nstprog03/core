<?php Ccc::loadClass('Model_Core_Row');

class Model_Product_CategoryProduct extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Product_CategoryProduct_Resource');
		parent::__construct();
	}

}

?>