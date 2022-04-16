<?php

class Np_Product_Block_Adminhtml_Product_Index_Edit_Tab_Media extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('media_form', array('legend'=>Mage::helper('product')->__('Media')));

            $fieldset->addField('name', 'text', array(
             'label' => Mage::helper('product')->__('SKU'),
             'class' => 'required-entry',
             'name' => 'name',
            ));
            $fieldset->addField('gallery', 'select', array(
            'label' => Mage::helper('product')->__('Status'),
            'name' => 'gallery',
            'values' => array(
                         array(
                         'value' => 1,
                         'label' => Mage::helper('product')->__('Active'),
                         ),

                        array(
                         'value' => 0,
                         'label' => Mage::helper('product')->__('Inactive'),
                         ),
                    ),
            ));


        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
            Mage::getSingleton('adminhtml/session')->setProData(null);
        } 
        elseif ( Mage::registry('product_data') ) 
        {
            $form->setValues(Mage::registry('product_data')->getData());
        }
        return parent::_prepareForm();
    }
}