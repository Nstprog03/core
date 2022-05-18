<?php
class Ccc_Process_Block_Adminhtml_Process_Column extends Mage_Adminhtml_Block_Widget_Grid_Container{

    public function __construct()
    {
        $this->_controller = 'adminhtml_process_column';
        $this->_blockGroup = 'process';
        $this->_headerText = Mage::helper('process')->__('View Data');
        $this->_addButtonLabel = Mage::helper('process')->__('Add Process Column');
        parent::__construct();
    }
}

?>