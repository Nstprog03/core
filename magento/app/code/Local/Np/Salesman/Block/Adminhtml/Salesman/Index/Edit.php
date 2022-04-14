<?php


	class Np_Salesman_Block_Adminhtml_Salesman_Index_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_salesman_index';

        $this->_updateButton('save', 'label', Mage::helper('salesman')->__('Save Data'));
        $this->_updateButton('delete', 'label', Mage::helper('salesman')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('salesman_data')->getId()) {
            return Mage::helper('salesman')->__('Edit Salesman');
        }
        else 
        {
            return Mage::helper('salesman')->__('New Salesman');
        }
    }
}
