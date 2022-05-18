<?php
class Ccc_User_Model_User extends Mage_Core_Model_Abstract {
	protected $_attributes;
	protected function _construct() {
		parent::_construct();
		$this->_init('user/user');
	}

	public function getAttributes() {
		if ($this->_attributes === null) {
			$this->_attributes = $this->_getResource()
				->loadAllAttributes($this)
				->getSortedAttributes();
		}
		return $this->_attributes;
	}

	public function checkInGroup($attributeId, $setId, $groupId) {
		$resource = Mage::getSingleton('core/resource');

		$readConnection = $resource->getConnection('core_read');

		$query = "SELECT * FROM
			{$resource->getTableName('eav/entity_attribute')}
			WHERE `attribute_id` = '{$attributeId}'
			AND `attribute_group_id` = '{$groupId}'
			AND `attribute_set_id` = '{$setId}'";
		$result = $readConnection->fetchRow($query);

		if ($result) {
			return true;
		}
		return false;
	}
}