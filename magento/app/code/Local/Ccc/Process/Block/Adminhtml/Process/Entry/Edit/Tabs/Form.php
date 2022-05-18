<?php

class Ccc_Process_Block_Adminhtml_Process_Entry_Edit_Tabs_Form extends Mage_Adminhtml_Block_Widget_Form
 {
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('process_form', array('legend'=>Mage::helper('process')->__('Process information')));

        $fieldset->addField('process_id', 'select', array(
        'label' => Mage::helper('process')->__('Process'),
        'class' => 'required-entry',
        'name' => 'process_id',
        'values' => $this->selectProcessIds()
        ));

        $fieldset->addField('identifier', 'text', array(
            'label' => Mage::helper('process')->__('Identifier'),
            'class' => 'required-entry',
            'name' => 'identifier',
        ));

        $fieldset->addField('start_time', 'time', array(
            'label' => Mage::helper('process')->__('Start Time'),
            'class' => 'required-entry',
            'name' => 'start_time',
            
        ));
        $fieldset->addField('end_time', 'time', array(
            'label' => Mage::helper('process')->__('End Time'),
            'class' => 'required-entry',
            'name' => 'end_time',
            
        ));
        $fieldset->addField('data', 'text', array(
            'label' => Mage::helper('process')->__('Data'),
            'class' => 'required-entry',
            'name' => 'data',
            
        ));

           

        if ( Mage::getSingleton('adminhtml/session')->getProData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProData());
            Mage::getSingleton('adminhtml/session')->setProData(null);
        }
        elseif ( Mage::registry('current_process_column') ) 
        {
            $form->setValues(Mage::registry('current_process_column')->getData());
        }
        return parent::_prepareForm();
    }
    public function selectProcessIDs()
    {
        $finalarray[] = array('value'=>null ,'label'=>'No Process');
        $allGroupIds = Mage::getModel('process/process')->getResource()->getReadConnection()->fetchAll("SELECT `process_id`,`name` FROM `process`");
            foreach ($allGroupIds as $data)
            {
                $label = $data['process_id']." => ".$data['name'];
                $array = array('value'=>$data['process_id'] ,'label'=>$label);
                $finalarray[]=$array;
            }
        return $finalarray;
    }
 }