<?php

class Np_Product_Block_Adminhtml_Product_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        
        parent::__construct();
        $this->setId('product_index');
        $this->setDefaultSort('type');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);

    }

    /**
     * Init product groups collection
     * @return void
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('product/product_collection');

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('product_id', array(
            'header' => Mage::helper('product')->__('ID'),
            'width' => '50px',
            'align' => 'right',
            'index' => 'product_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('product')->__('Name'),
            'index' => 'name',
        ));
        $this->addColumn('quantity', array(
            'header' => Mage::helper('product')->__('Quantity'),
            'index' => 'quantity',
        ));

        $this->addColumn('price', array(
            'header' => Mage::helper('product')->__('Price'),
            'index' => 'price',
            'width' => '200px'
        ));
        $this->addColumn('costPrice', array(
            'header' => Mage::helper('product')->__('Cost Price'),
            'index' => 'costPrice',
            'width' => '200px'
        ));
        $this->addColumn('sku', array(
            'header' => Mage::helper('product')->__('SKU'),
            'index' => 'sku',
            'width' => '200px'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

}