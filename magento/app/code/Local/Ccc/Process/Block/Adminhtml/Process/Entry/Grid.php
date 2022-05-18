<?php

class Ccc_Process_Block_Adminhtml_Process_Entry_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('columnGrid');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Init category columns collection
     * @return void
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('process/entry')->getCollection();
        foreach ($collection->getItems() as $data) 
        {
            $data->process_id = Mage::getModel('process/process')->load($data->process_id)->name;
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('process')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'entity_id',
        ));
        $this->addColumn('entry_id', array(
            'header' => Mage::helper('process')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'entry_id',
        ));

        $this->addColumn('process_id', array(
            'header' => Mage::helper('process')->__('Process Id'),
            'index' => 'process_id',
        ));

        $this->addColumn('identifier', array(
            'header' => Mage::helper('process')->__('Identifier'),
            'index' => 'identifier',
        ));

        $this->addColumn('start_time', array(
            'header' => Mage::helper('process')->__('Start Time'),
            'index' => 'start_time',
            'type' => 'date',
        ));

        $this->addColumn('end_time', array(
            'header' => Mage::helper('process')->__('End Time'),
            'index' => 'end_time',
            'type' => 'date',
        ));

        $this->addColumn('data', array(
            'header' => Mage::helper('process')->__('Data'),
            'index' => 'data',
        ));

        $this->addColumn('created_date', array(
            'header' => Mage::helper('process')->__('Created Date'),
            'index' => 'created_date',
            'type' => 'date',
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entry_id');
        $this->getMassactionBlock()->setFormFieldName('entry');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('process')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('process')->__('Are you sure?')
        ));
    }

}