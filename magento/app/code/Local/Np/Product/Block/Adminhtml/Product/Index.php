<?php 
class Np_Product_Block_Adminhtml_Product_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'product';
		$this->_controller = 'adminhtml_product_index';
        $this->_headerText = Mage::helper('product')->__('Manage Product');
        $this->_addButtonLabel = Mage::helper('product')->__('Add New Product');
        parent::__construct();
	}
}