<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer_Price extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Customer_Price_Resource');
		parent::__construct();
	}

}

?>