<?php


	class Np_Category_Block_Adminhtml_Category_Index_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'category';
        $this->_controller = 'adminhtml_category_index';

        $this->_updateButton('save', 'label', Mage::helper('category')->__('Save Data'));
        $this->_updateButton('delete', 'label', Mage::helper('category')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('category_data')->getId()) {
            return Mage::helper('category')->__('Edit Category');
        }
        else 
        {
            return Mage::helper('category')->__('New Category');
        }
    }
}
