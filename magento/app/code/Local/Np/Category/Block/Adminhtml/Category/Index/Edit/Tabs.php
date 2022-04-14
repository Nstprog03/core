
<?php
 class Np_Category_Block_Adminhtml_Category_Index_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('category_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('category')->__('Category Info.'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
        'name' => Mage::helper('category')->__('Name'),
        'content' => $this->getLayout()->createBlock('category/adminhtml_category_index_edit_tab_form')->toHtml(),));


        return parent::_beforeToHtml();
    }
 }