	<?php Ccc::loadClass('Model_Core_Table');

class Model_Customer extends Model_Core_Table
{
	public function __construct($tableName = 'customer')
	{
		$this->setTableName($tableName)->setPrimaryKey('customer_id');
	}

}





	?>