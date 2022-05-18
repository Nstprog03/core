<?php
class Ccc_User_Block_Adminhtml_User_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

	public function __construct() {
		parent::__construct();
		$this->setId('user_attribute_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('user')->__('Attribute Information'));
	}

	protected function _beforeToHtml() {
		$this->addTab('main', array(
			'label' => Mage::helper('user')->__('Properties'),
			'title' => Mage::helper('user')->__('Properties'),
			'content' => $this->getLayout()->createBlock('user/adminhtml_user_attribute_edit_tab_main')->toHtml(),
			'active' => true,
		));

		$model = Mage::registry('entity_attribute');

		$this->addTab('labels', array(
			'label' => Mage::helper('user')->__('Manage Label / Options'),
			'title' => Mage::helper('user')->__('Manage Label / Options'),
			'content' => $this->getLayout()->createBlock('user/adminhtml_user_attribute_edit_tab_options')->toHtml(),
		));
		return parent::_beforeToHtml();
	}
}