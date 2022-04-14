<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        // echo "1111";
        // exit;
        parent::__construct();
        $this->setId('vendor_index');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    /**
     * Init vendor groups collection
     * @return void
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('vendor/vendor_collection');

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('vendor_id', array(
            'header' => Mage::helper('vendor')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'vendor_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('vendor')->__('Name'),
            'index' => 'name',
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('vendor')->__('Email'),
            'index' => 'email',
            'width' => '200px'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

}