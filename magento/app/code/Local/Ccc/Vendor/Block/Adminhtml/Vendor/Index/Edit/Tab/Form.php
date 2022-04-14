<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Index_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('vendor_form', array('legend'=>Mage::helper('vendor')->__('vendor information')));

        $fieldset->addField('name', 'text', array(
         'label' => Mage::helper('vendor')->__('Name'),
         'class' => 'required-entry',
         'name' => 'name',
         ));

        $fieldset->addField('email', 'text', array(
         'label' => Mage::helper('vendor')->__('Email'),
         'class' => 'required-entry',
         'name' => 'email',
         ));

        $fieldset->addField('mobile', 'text', array(
         'label' => Mage::helper('vendor')->__('Mobile'),
         'class' => 'required-entry',
         'name' => 'mobile',
         ));


        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
            Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('vendor_data') ) 
        {
            $form->setValues(Mage::registry('vendor_data')->getData());
        }
        return parent::_prepareForm();
    }
}