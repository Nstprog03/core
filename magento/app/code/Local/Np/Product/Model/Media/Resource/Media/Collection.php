<?php 
class Np_Product_Model_Media_Resource_Media_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	public function _construct()
	{
		$this->_init("product/product_media");
	}
}