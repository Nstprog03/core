<?php 
class Ccc_Process_Model_Resource_Column_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	public function _construct()
	{
		$this->_init("process/column");
	}
}