<?php


	class Np_Product_Block_Adminhtml_Product_Index_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'product';
        $this->_controller = 'adminhtml_product_index';

        $this->_updateButton('save', 'label', Mage::helper('product')->__('Save Data'));
        $this->_updateButton('delete', 'label', Mage::helper('product')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('product_data')->getId()) {
            return Mage::helper('product')->__('Edit Product');
        }
        else 
        {
            return Mage::helper('product')->__('New Product');
        }
    }
}
