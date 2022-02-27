<?php Ccc::loadClass('Model_Core_Row');

class Model_Product_Media extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Product_Media_Resource');
		parent::__construct();
	}

}

?>