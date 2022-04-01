<?php Ccc::loadClass('Block_Core_Template');

class Block_Customer_Index extends Block_Core_Template	   
{
	protected $tab = null; 

	public function __construct()
	{
		$this->setTemplate("view/customer/index.php");
	}
}