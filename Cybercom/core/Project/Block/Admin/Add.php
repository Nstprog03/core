<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Add extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/admin/add.php');
	}
	
}
?>