<?php
class Np_Vendor_Block_Adminhtml_Vendor_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container {
	public function __construct() {
		$this->_controller = 'adminhtml_vendor_attribute';
		$this->_blockGroup = 'vendor';
		$this->_headerText = 'Manage Attribute';
		parent::__construct();
	}
}