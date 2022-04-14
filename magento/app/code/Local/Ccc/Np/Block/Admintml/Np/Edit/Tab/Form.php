<?php

class Ccc_NP_Block_Adminhtml_NP_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
 {
 protected function _prepareForm()
 {
 $form = new Varien_Data_Form();
 $this->setForm($form);
 $fieldset = $form->addFieldset('np_form', array('legend'=>Mage::helper('np')->__('Student information')));

$fieldset->addField('stdname', 'text', array(
 'label' => Mage::helper('np')->__('Name'),
 'class' => 'required-entry',
 //'required' => true,
 //'readonly' => true,
 'name' => 'stdname',
 ));

$fieldset->addField('email', 'text', array(
 'label' => Mage::helper('np')->__('Email'),
 'class' => 'required-entry',
 //'required' => true,
 'name' => 'email',
 //'readonly' => true,
 ));

$fieldset->addField('rollno', 'text', array(
 'label' => Mage::helper('np')->__('Telephone'),
 'class' => 'required-entry',
 //'required' => true,
 'name' => 'rollno',
 //'readonly' => true,
 ));

$fieldset->addField('status', 'select', array(
 'label' => Mage::helper('np')->__('Status'),
 'name' => 'status',
 'values' => array(
 array(
 'value' => 1,
 'label' => Mage::helper('np')->__('Active'),
 ),

array(
 'value' => 0,
 'label' => Mage::helper('np')->__('Inactive'),
 ),
 ),
 ));

if ( Mage::getSingleton('adminhtml/session')->getProData() )
 {
 $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
 Mage::getSingleton('adminhtml/session')->setProData(null);
 } elseif ( Mage::registry('np_data') ) {
 $form->setValues(Mage::registry('np_data')->getData());
 }
 return parent::_prepareForm();
 }
 }