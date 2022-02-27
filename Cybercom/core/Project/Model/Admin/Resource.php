<?php Ccc::loadClass('Model_Core_Row_Resource');
class Model_Admin_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('admin')->setPrimaryKey('adminId');
		parent::__construct();
	}
}