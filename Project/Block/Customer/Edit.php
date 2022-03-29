<?php
Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Customer_Edit_Tab');
class Block_Customer_Edit extends Block_Core_Edit   
{ 
	protected $tab = null; 
	public function __construct()
	{
		parent::__construct();
	}
	
   	public function getEditUrl()
	{
		return $this->getUrl('save','customer');
	}
   
}