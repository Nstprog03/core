<?php 
class Ccc_Process_Model_Resource_Entry extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('process/entry','entry_id');
	}
}