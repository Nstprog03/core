<?php

class Ccc_Process_Block_Adminhtml_Process_Group_Edit_Tabs_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('Process information')));

		$fieldset->addField('name', 'text', array(
			'label' => Mage::helper('process')->__('Name'),
			'class' => 'required-entry',
			//'required' => true,
			//'readonly' => true,
			'name' => 'name',
		));

		if ( Mage::getSingleton('adminhtml/session')->getProData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
			Mage::getSingleton('adminhtml/session')->setProData(null);
		}
		elseif ( Mage::registry('current_process_group') ) 
		{
			$form->setValues(Mage::registry('current_process_group')->getData());
		}
		return parent::_prepareForm();
	 }
 }