<?php 
class Ccc_Process_Model_Resource_Pro extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('process/pro','pro_id');
	}
}