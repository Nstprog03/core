<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Page_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('page')->setPrimaryKey('pageId');
		parent::__construct();
	}
}