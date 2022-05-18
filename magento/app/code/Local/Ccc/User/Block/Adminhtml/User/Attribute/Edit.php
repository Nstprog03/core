<?php

class Ccc_User_Block_Adminhtml_User_Attribute_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		$this->_objectId = 'attribute_id';
		$this->_controller = 'adminhtml_user_attribute';
		$this->_blockGroup = 'user';
		$this->_headerText = 'Attribute';
		parent::__construct();

	}

}