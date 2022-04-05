<?php Ccc::loadClass('Model_Core_Row');

class Model_Order_Comment extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Order_Comment_Resource');
		parent::__construct();
	}

}

?>