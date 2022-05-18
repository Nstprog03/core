<?php
class Np_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_block_Widget_Form_Container {
	public function __construct() {
		$this->_controller = 'adminhtml_vendor';
		$this->_blockGroup = 'vendor';
		$this->_headerText = 'Edit Vendor';
		parent::__construct();
	}
}