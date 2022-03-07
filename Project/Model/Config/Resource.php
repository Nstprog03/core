<?php Ccc::loadClass('Model_Core_Row_Resource');
class Model_Config_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('config')->setPrimaryKey('configId');
		parent::__construct();
	}
}