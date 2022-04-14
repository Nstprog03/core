<?php 
class Np_Salesman_Block_Adminhtml_Salesman_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'salesman';
		$this->_controller = 'adminhtml_salesman_index';
        $this->_headerText = Mage::helper('salesman')->__('Manage Salesman');
        $this->_addButtonLabel = Mage::helper('salesman')->__('Add New Salesman');
        parent::__construct();
	}
}