<?php Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/edit.php');
	}
	public function getSalesman()
	{
		return $this->getData('salesman');
	}
	
}