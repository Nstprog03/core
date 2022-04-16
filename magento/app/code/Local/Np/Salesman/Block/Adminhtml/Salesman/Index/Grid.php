<?php

class Np_Salesman_Block_Adminhtml_Salesman_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        
        parent::__construct();
        $this->setId('salesman_index');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    /**
     * Init salesman groups collection
     * @return void
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('salesman/salesman_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('salesman_id', array(
            'header' => Mage::helper('salesman')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'salesman_id',
        ));

        $this->addColumn('firstName', array(
            'header' => Mage::helper('salesman')->__('First Name'),
            'index' => 'firstName',
        ));
        $this->addColumn('lastName', array(
            'header' => Mage::helper('salesman')->__('Last Name'),
            'index' => 'lastName',
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('salesman')->__('Email'),
            'index' => 'email',
            'width' => '200px'
        ));
        $this->addColumn('mobile', array(
            'header' => Mage::helper('salesman')->__('Mobile'),
            'index' => 'mobile',
            'width' => '200px'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

}