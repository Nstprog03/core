<?php
class Ccc_Process_Block_Adminhtml_Process_Column_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('process_column_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('process')->__('Process Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'label' => Mage::helper('process')->__('Process Data'),
        'name' => Mage::helper('process')->__('Process Name'),
        'content' => $this->getLayout()->createBlock('process/adminhtml_process_column_edit_tabs_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}

?>