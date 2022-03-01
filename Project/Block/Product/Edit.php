<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{

		$this->setTemplate('view/product/edit.php');
	}
	
	public function getProduct()
   	{
  
   		return $this->getData('product');
   	}
}
?>