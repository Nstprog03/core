<?php
class Ccc_Process_Block_Adminhtml_Process_Entry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process_entry';
        $this->_updateButton('save', 'label', Mage::helper('process')->__('Save Data'));
        $this->_updateButton('delete', 'label', Mage::helper('process')->__('Delete Item'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('current_process_entry') && Mage::registry('current_process_entry')->getId() ) {
        return Mage::helper('process')->__("View Process Entry Data", $this->htmlEscape(Mage::registry('current_process_entry')->getTitle()));
        } else {
        return Mage::helper('process')->__('Process Entry Information');
    }
    }

}

?>