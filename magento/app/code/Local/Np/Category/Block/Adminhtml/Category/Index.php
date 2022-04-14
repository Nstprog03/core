<?php 
class Np_Category_Block_Adminhtml_Category_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'category';
		$this->_controller = 'adminhtml_category_index';
        $this->_headerText = Mage::helper('category')->__('Manage Category');
        $this->_addButtonLabel = Mage::helper('category')->__('Add New Category');
        parent::__construct();
	}
}