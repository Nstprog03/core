<?php
class Ccc_Process_Block_Adminhtml_Process_Upload_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'process';
        $this->_controller = 'adminhtml_process_upload';
        $this->_updateButton('save', 'label', Mage::helper('process')->__('Upload File'));
    }
}

?>