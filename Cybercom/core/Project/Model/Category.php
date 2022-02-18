<?php Ccc::loadClass('Model_Core_Table');

class Model_Category extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('category')->setPrimaryKey('categoryId');
	}

}

?>