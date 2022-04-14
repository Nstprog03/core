<?php
 class Ccc_Np_Block_Adminhtml_Np extends Mage_Adminhtml_Block_Widget_Grid_Container
 {
 public function __construct()
 {
 $this->_controller = 'adminhtml_np';
 $this->_blockGroup = 'np';
 $this->_headerText = Mage::helper('np')->__('View Data');
 $this->_addButtonLabel = Mage::helper('np')->__('Edit Status');
 parent::__construct();
 }
 }



