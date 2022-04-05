<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Order_Comment_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('order_comment')->setPrimaryKey('commentId');
		parent::__construct();
	}

}


?>