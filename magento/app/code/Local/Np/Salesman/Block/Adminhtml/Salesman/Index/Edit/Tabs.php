
<?php
 class Np_Salesman_Block_Adminhtml_Salesman_Index_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('salesman_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('salesman')->__('Salesman Info.'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'firstname' => Mage::helper('salesman')->__('First Name'),
        'lastname' => Mage::helper('salesman')->__('Last Name'),
        'email' => Mage::helper('salesman')->__('Email'),
        'mobile' => Mage::helper('salesman')->__('Mobile'),
        'content' => $this->getLayout()->createBlock('salesman/adminhtml_salesman_index_edit_tab_form')->toHtml(),));


        return parent::_beforeToHtml();
    }
 }