<?php 
class Ccc_Vendor_Block_Adminhtml_Vendor_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'vendor';
		$this->_controller = 'adminhtml_vendor_index';
        $this->_headerText = Mage::helper('vendor')->__('Manage Vendor');
        $this->_addButtonLabel = Mage::helper('vendor')->__('Add New Vendor');
        parent::__construct();
		// parent::__construct();
		// $this->setTemplate("vendor/vendor/index.phtml");
	}

	
}