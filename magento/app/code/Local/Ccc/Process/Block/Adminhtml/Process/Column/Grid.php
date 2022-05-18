<?php

class Ccc_Process_Block_Adminhtml_Process_Column_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getModel('process/column')->getCollection();
        foreach ($collection->getItems() as $data) 
        {
            $data->process_id = Mage::getModel('process/process')->load($data->process_id)->name;
            $data->casting_type = Mage::getModel('process/column')->load($data->getId())->getCastingType();
            $data->required = Mage::getModel('process/column')->load($data->getId())->getRequired();
            $data->exception = Mage::getModel('process/column')->load($data->getId())->getIsException();
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('column_id', array(
            'header' => Mage::helper('process')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'column_id',
        ));

        $this->addColumn('process_id', array(
            'header' => Mage::helper('process')->__('Process Id'),
            'index' => 'process_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('process')->__('Name'),
            'index' => 'name',
        ));

        $this->addColumn('required', array(
            'header' => Mage::helper('process')->__('Required'),
            'index' => 'required',
        ));

        $this->addColumn('casting_type', array(
            'header' => Mage::helper('process')->__('Casting Type'),
            'index' => 'casting_type',
        ));

        $this->addColumn('sample_data', array(
            'header' => Mage::helper('process')->__('Sample Data'),
            'index' => 'sample_data',
        ));

        $this->addColumn('exception', array(
            'header' => Mage::helper('process')->__('Exception'),
            'index' => 'exception',
        ));

        $this->addColumn('createdDate', array(
            'header' => Mage::helper('process')->__('Created Date'),
            'index' => 'createdDate',
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
        $this->setMassactionIdField('column_id');
        $this->getMassactionBlock()->setFormFieldName('column');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('process')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('process')->__('Are you sure?')
        ));
    }

}