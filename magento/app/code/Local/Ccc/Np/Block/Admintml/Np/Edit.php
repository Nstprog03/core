<?php

class Ccc_Np_Block_Adminhtml_Np_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
 {
 public function __construct()
 {
 parent::__construct();
 $this->_objectId = 'id';
 $this->_blockGroup = 'np';
 $this->_controller = 'adminhtml_np';

$this->_updateButton('save', 'label', Mage::helper('np')->__('Save Data'));
 $this->_updateButton('delete', 'label', Mage::helper('np')->__('Delete Item'));
 }

public function getHeaderText()
 {
 if( Mage::registry('np_data') && Mage::registry('np_data')->getId() ) {
 return Mage::helper('np')->__("View Student Data '%s'", $this->htmlEscape(Mage::registry('np_data')->getTitle()));
 } else {
 return Mage::helper('np')->__('Student Information');
 }
 }
 }