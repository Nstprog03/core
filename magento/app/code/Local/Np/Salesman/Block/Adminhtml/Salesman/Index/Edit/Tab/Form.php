<?php

class Np_Salesman_Block_Adminhtml_Salesman_Index_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('salesman_form', array('legend'=>Mage::helper('salesman')->__('salesman information')));

        $fieldset->addField('firstName', 'text', array(
         'label' => Mage::helper('salesman')->__('First Name'),
         'class' => 'required-entry',
         'name' => 'firstName',
         ));
        $fieldset->addField('lastName', 'text', array(
         'label' => Mage::helper('salesman')->__('Last Name'),
         'class' => 'required-entry',
         'name' => 'lastName',
         ));
        $fieldset->addField('email', 'text', array(
         'label' => Mage::helper('salesman')->__('Email'),
         'class' => 'required-entry',
         'name' => 'email',
         ));

        $fieldset->addField('mobile', 'text', array(
         'label' => Mage::helper('salesman')->__('Mobile'),
         'class' => 'required-entry',
         'name' => 'mobile',
         ));


        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
            Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('salesman_data') ) 
        {
            $form->setValues(Mage::registry('salesman_data')->getData());
        }
        return parent::_prepareForm();
    }
}