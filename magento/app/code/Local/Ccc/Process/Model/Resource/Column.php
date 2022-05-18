<?php 
class Ccc_Process_Model_Resource_Column extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('process/column','column_id');
	}
}