<?php
class Ccc_User_Block_Adminhtml_User_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container {
	public function __construct() {
		$this->_controller = 'adminhtml_user_attribute';
		$this->_blockGroup = 'user';
		$this->_headerText = 'Manage Attribute';
		parent::__construct();
	}
}