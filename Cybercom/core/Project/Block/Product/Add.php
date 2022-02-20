<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Add extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/product/add.php');
	}
	
}
?>