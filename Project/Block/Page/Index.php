<?php Ccc::loadClass('Block_Core_Template');

class Block_Page_Index extends Block_Core_Template	   
{
	protected $tab = null; 

	public function __construct()
	{
		$this->setTemplate("view/page/index.php");
	}
}