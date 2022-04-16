<?php 
class Np_Category_Block_Adminhtml_Category_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{

		
		//var_dump($results);
		//$resource = Mage::getResourceModel('category/category');
		// $resource = Mage::getSingleton('category/category');
			
		// $resource->getConnection('core_read');
		// $resource->getReadConnection();

		// print_r($resource);
		// exit;

		$this->_blockGroup = 'category';
		$this->_controller = 'adminhtml_category_index';
        $this->_headerText = Mage::helper('category')->__('Manage Category');
        $this->_addButtonLabel = Mage::helper('category')->__('Add New Category');
        parent::__construct();
	}
}