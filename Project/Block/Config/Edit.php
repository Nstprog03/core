<?php
Ccc::loadClass('Block_Core_Template');
class Block_Config_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/config/edit.php');
	}
	
	public function getConfig()
   	{
   		return $this->getData('config');
   	}
}
?>