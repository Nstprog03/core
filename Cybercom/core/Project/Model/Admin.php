<?php Ccc::loadClass('Model_Core_Table');

class Model_Admin extends Model_Core_Table
{
	//protected $tableName = NULL;
	//protected $primeryKey = Null;

	public function __construct()
	{
		//print_r(get_class_methods($this));
		//exit();
		$this->setTableName('admin');
		$this->setPrimaryKey('admin_id');

		//print_r($this);
	}

}





	?>