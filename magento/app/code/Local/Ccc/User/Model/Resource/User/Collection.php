<?php
class Ccc_User_Model_Resource_User_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract {
	public function __construct() {
		$this->setEntity('user');
		parent::__construct();

	}
}