<?php

class Np_Vendor_Block_Adminhtml_Vendor_Attribute_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

	public function __construct() {
		$this->_objectId = 'attribute_id';
		$this->_controller = 'adminhtml_vendor_attribute';
		$this->_blockGroup = 'vendor';
		$this->_headerText = 'Attribute';
		parent::__construct();

	}

}