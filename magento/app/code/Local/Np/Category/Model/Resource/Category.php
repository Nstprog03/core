<?php 
class Np_Category_Model_Resource_Category extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('category/category','category_id');
	}
}