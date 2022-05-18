<?php

class Ccc_Process_Block_Adminhtml_Process_Column_Edit_Tabs_Form extends Mage_Adminhtml_Block_Widget_Form
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

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('process')->__('Name'),
            'class' => 'required-entry',
            'name' => 'name',
        ));

        $fieldset->addField('required', 'select', array(
            'label' => Mage::helper('process')->__('Required'),
            'class' => 'required-entry',
            'name' => 'required',
            'values' => array(
                         array(
                         'value' => 1,
                         'label' => Mage::helper('process')->__('Yes'),
                         ),

                        array(
                         'value' => 2,
                         'label' => Mage::helper('process')->__('No'),
                         ),
                    ),
        ));

        $fieldset->addField('casting_type', 'select', array(
            'label' => Mage::helper('process')->__('Casting Type'),
            'class' => 'required-entry',
            'name' => 'casting_type',
            'values' => array(
                         array(
                         'value' => 1,
                         'label' => Mage::helper('process')->__('Varchar'),
                         ),

                        array(
                         'value' => 2,
                         'label' => Mage::helper('process')->__('Int'),
                         ),
                        array(
                         'value' => 3,
                         'label' => Mage::helper('process')->__('Decimal'),
                         ),
                        array(
                         'value' => 4,
                         'label' => Mage::helper('process')->__('Text'),
                         ),
                    ),
        ));
        $fieldset->addField('sample_data', 'text', array(
            'label' => Mage::helper('process')->__('Sample Data'),
            //'class' => 'required-entry',
            'name' => 'sample_data',
        ));

        $fieldset->addField('exception', 'select', array(
            'label' => Mage::helper('process')->__('Exception'),
            'class' => 'required-entry',
            'name' => 'exception',
            'values' => array(
                         array(
                         'value' => 1,
                         'label' => Mage::helper('process')->__('Yes'),
                         ),

                        array(
                         'value' => 2,
                         'label' => Mage::helper('process')->__('No'),
                         ),
                    ),
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