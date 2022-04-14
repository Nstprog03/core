

<?php
 class Ccc_Np_Block_Adminhtml_Np_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
 {

public function __construct()
 {
 parent::__construct();
 $this->setId('np_tabs');
 $this->setDestElementId('edit_form');
 $this->setTitle(Mage::helper('np')->__('Student Information'));
 }

protected function _beforeToHtml()
 {
 $this->addTab('form_section', array(
 'label' => Mage::helper('np')->__('Student Data'),
 'stdname' => Mage::helper('np')->__('Student Name'),
 'email' => Mage::helper('np')->__('Student Email'),
 'rollno' => Mage::helper('np')->__('Student Roll No'),
 'content' => $this->getLayout()->createBlock('np/adminhtml_np_edit_tab_form')->toHtml(),
 ));


return parent::_beforeToHtml();
 }
 }