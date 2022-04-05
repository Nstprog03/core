<?php
Ccc::loadClass('Block_Core_Template');
class Block_Cart_Index extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/cart/index.php');
	}
}
?>