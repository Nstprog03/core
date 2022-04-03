<?php Ccc::loadClass('Block_Core_Template');

class Block_Vendor_Index extends Block_Core_Template	   
{
	protected $tab = null; 

	public function __construct()
	{
		$this->setTemplate("view/vendor/index.php");
	}
}