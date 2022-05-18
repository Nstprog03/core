<?php

class Ccc_Process_Block_Adminhtml_Process_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('processGrid');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('process/process')->getCollection();

        $this->setCollection($collection);
        foreach ($collection->getItems() as $data) 
        {
            $data->group_id = Mage::getModel('process/group')->load($data->group_id)->name;
            $data->type_id = Mage::getModel('process/process')->load($data->getId())->getType();
        }
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('process_id', array(
            'header' => Mage::helper('process')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'process_id',
        ));

        $this->addColumn('group_id', array(
            'header' => Mage::helper('process')->__('Group'),
            'index' => 'group_id',
        ));

        $this->addColumn('type_id', array(
            'header' => Mage::helper('process')->__('Type Id'),
            'index' => 'type_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('process')->__('Name'),
            'index' => 'name',
        ));

        $this->addColumn('perRequestCount', array(
            'header' => Mage::helper('process')->__('Per Request Count'),
            'index' => 'perRequestCount',
        ));

        $this->addColumn('requestInterval', array(
            'header' => Mage::helper('process')->__('Request Interval'),
            'index' => 'requestInterval',
        ));

        $this->addColumn('requestModel', array(
            'header' => Mage::helper('process')->__('Request model'),
            'index' => 'requestModel',
        ));

        $this->addColumn('fileName', array(
            'header' => Mage::helper('process')->__('File Name'),
            'index' => 'fileName',
        ));

        $this->addColumn('createdDate', array(
            'header' => Mage::helper('process')->__('Created Date'),
            'index' => 'createdDate',
            'type' => 'date',
        ));
       
    $this->addColumn('default', array(
            'header'    =>  Mage::helper('process')->__('Download default'),
            'width'     => '100',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('process')->__('Download'),
                    'url'       => array('base'=> '*/adminhtml_process/exportCsv'),
                    'field'     => 'id'
                ),
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,
    ));
        $this->addColumn('upload', array(
            'header'    =>  Mage::helper('process')->__('Upload'),
            'width'     => '100',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('process')->__('Upload'),
                    'url'       => array('base'=> '*/adminhtml_process_upload/uploadfile'),
                    'field'     => 'id'
                ),
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,
    ));

    $this->addColumn('verify', array(
            'header'    =>  Mage::helper('process')->__('Verify'),
            'width'     => '100',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('process')->__('Verify'),
                    'url'       => array('base'=> '*/adminhtml_process_upload/verify'),
                    'field'     => 'id'
                ),

            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,
    ));

    $this->addColumn('execution', array(
            'header'    =>  Mage::helper('process')->__('Execute'),
            'width'     => '100',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('process')->__('Execute'),
                    'url'       => array('base'=> '*/adminhtml_process_upload/execute'),
                    'field'     => 'id'
                ),
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,
    ));
    return parent::_prepareColumns();
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('process_id');
        $this->getMassactionBlock()->setFormFieldName('process');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('process')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('process')->__('Are you sure?')
        ));
        $this->getMassactionBlock()->addItem('delete_entrys', array(
             'label'    => Mage::helper('process')->__('Delete Entrys'),
             'url'      => $this->getUrl('*/*/massDeleteEntrys'),
             'confirm'  => Mage::helper('process')->__('Delete karvu j chhe Pakku?')
        ));

    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

}