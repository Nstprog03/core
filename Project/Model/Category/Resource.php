<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Category_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('category')->setPrimaryKey('categoryId');
		parent::__construct();
	}

}


?>