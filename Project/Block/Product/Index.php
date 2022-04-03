<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Index extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/product/index.php');
	}
		
}
