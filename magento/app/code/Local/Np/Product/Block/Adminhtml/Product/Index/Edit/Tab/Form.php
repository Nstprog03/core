<?php

class Np_Product_Block_Adminhtml_Product_Index_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('product_form', array('legend'=>Mage::helper('product')->__('product information')));

        $fieldset->addField('name', 'text', array(
         'label' => Mage::helper('product')->__('Name'),
         'class' => 'required-entry',
         'name' => 'name',
         ));
        $fieldset->addField('category_id', 'select', array(
         'label' => Mage::helper('product')->__('Select Category'),
         'name' => 'category_id',
         'values' => $this->selectPaths()
        ));
        $fieldset->addField('quantity', 'text', array(
         'label' => Mage::helper('product')->__('Quantity'),
         'class' => 'required-entry',
         'name' => 'quantity',
         ));
        $fieldset->addField('price', 'text', array(
         'label' => Mage::helper('product')->__('Price'),
         'class' => 'required-entry',
         'name' => 'price',
         ));

        $fieldset->addField('costPrice', 'text', array(
         'label' => Mage::helper('product')->__('Cost Price'),
         'class' => 'required-entry',
         'name' => 'costPrice',
         ));
        $fieldset->addField('sku', 'text', array(
         'label' => Mage::helper('product')->__('SKU'),
         'class' => 'required-entry',
         'name' => 'sku',
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
    public function selectPaths()
    {
        $id = $this->getRequest()->getParam('id');
        $categories = Mage::getModel('category/category')->getCollection()->getItems();
        $finalarray = [];
        $finalarray['root'] = array('value'=>null ,'label'=>'No Category');
        $allPath = Mage::getModel('category/category')->getResource()->getReadConnection()->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        foreach ($categories as $category) 
        {
            foreach ($allPath as $data)
            {
                if($category->category_id == $data['category_id'])
                {
                    $category_id=$category->category_id;
                    $path = $category->getPath();
                    $array = array('value'=>$category_id ,'label'=>$path);
                    $finalarray[$category_id]=$array;
                }
            }
            
        }
        return $finalarray;
    }
}