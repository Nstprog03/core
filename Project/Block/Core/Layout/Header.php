<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout_Header extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/header.php');
	}
}