<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout extends Block_Core_Template
{

	
	public function __construct()
	{
		$this->setTemplate('view/core/layout.php');
		$this->setLayout($this);
	}
	
	public function getHeader()
	{
		$child = $this->getChild('Header');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header');
			$this->addChild($child,'Header');
		}
		return $child;
	}

	public function getHead()
	{
		$child = $this->getChild('Head');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Head');
			$this->addChild($child,'Head');
		}
		return $child;
	}

	public function getFooter()
	{
		$child = $this->getChild('Footer');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Footer');
			$this->addChild($child,'Footer');
		}
		return $child;
	}
	public function getContent()
	{
		$child = $this->getChild('Content');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Content');
			$this->addChild($child,'Content');
		}
		return $child;
	}

}