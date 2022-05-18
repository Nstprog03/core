<?php
class Ccc_Process_Block_Adminhtml_Process_Group extends Mage_Adminhtml_Block_Widget_Grid_Container{

    public function __construct()
    {
        $this->_controller = 'adminhtml_process_group';
        $this->_blockGroup = 'process';
        $this->_headerText = Mage::helper('process')->__('View Data');
        $this->_addButtonLabel = Mage::helper('process')->__('Add Process Group');
        parent::__construct();
    }
}

?>