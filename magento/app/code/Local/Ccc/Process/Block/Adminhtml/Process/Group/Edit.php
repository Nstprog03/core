<?php
class Ccc_Process_Block_Adminhtml_Process_Group_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process_group';
        $this->_updateButton('save', 'label', Mage::helper('process')->__('Save Data'));
        $this->_updateButton('delete', 'label', Mage::helper('process')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('current_process_group') && Mage::registry('current_process_group')->getId() ) {
        return Mage::helper('process')->__("View Process Group Data", $this->htmlEscape(Mage::registry('current_process_group')->getTitle()));
        } else {
        return Mage::helper('process')->__('Process Group Information');
    }
    }

}

?>