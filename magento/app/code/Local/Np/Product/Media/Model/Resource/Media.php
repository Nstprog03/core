<?php 
class Np_Product_Media_Model_Resource_Product extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('product_media/product_media','media_id');
	}
}