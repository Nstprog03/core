<?php 
class Np_Salesman_Model_Resource_Salesman_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	public function _construct()
	{
		$this->_init("salesman/salesman");
	}
}