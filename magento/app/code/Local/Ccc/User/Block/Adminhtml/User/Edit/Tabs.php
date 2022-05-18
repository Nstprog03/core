<?php
class Ccc_user_Block_Adminhtml_user_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

	public function __construct() {
		parent::__construct();
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('user')->__('User Information'));
	}

	public function getuser() {
		return Mage::registry('current_user');
	}

	protected function _beforeToHtml() {
		$userAttributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter(Mage::getModel('eav/entity')->setType(Ccc_User_Model_Resource_User::ENTITY)->getTypeId());
		if (!$this->getuser()->getId()) {
			foreach ($userAttributes as $attribute) {
				$default = $attribute->getDefaultValue();
				if ($default != null) {
					$this->getuser()->setData($attribute->getAttributeCode(), $default);
				}
			}
		}

		$attributeSetId = $this->getuser()->getResource()->getEntityType()->getDefaultAttributeSetId();

		$groupCollection = Mage::getResourceModel('eav/entity_attribute_group_collection')
			->setAttributeSetFilter($attributeSetId)
			->setSortOrder()
			->load();

		$defaultGroupId = 0;
		foreach ($groupCollection as $group) {
			if ($defaultGroupId == 0 || $group->getIsDefault()) {
				$defaultGroupId = $group->getId();
			}
			$attributes = [];
			foreach ($userAttributes as $attribute) {
				if ($this->getuser()->checkInGroup($attribute->getId(), $attributeSetId, $group->getId())) {
					$attributes[] = $attribute;
				}
			}

			if (!$attributes) {
				continue;
			}

			$active = $defaultGroupId == $group->getId();

			$block = $this->getLayout()->createBlock('user/adminhtml_user_edit_tab_attributes')
				->setGroup($group)
				->setAttributes($attributes)
				->setAddHiddenFields($active)
				->toHtml();

			$this->addTab('group_' . $group->getId(), [
				'label' => Mage::helper('user')->__($group->getAttributeGroupName()),
				'content' => $block,
				'active' => $active,
			]);
		}

		return parent::_beforeToHtml();

	}
}