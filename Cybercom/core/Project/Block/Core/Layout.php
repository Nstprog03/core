<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout extends Block_Core_Template
{

	protected $children = [];
	public function __construct()
	{
		$this->setTemplate('view/core/layout.php');
	}

	public function getChildern()
	{
		return $this->children;
	}
	public function setChildren($children)
	{
		$this->children=$children;
		return $this;
	}

	public function setChild($key,$value)
	{
		$this->children[$key]=$value;
		return $this;
	}
	public function getChild($key)
	{
		if(array_key_exists($key,$this->children))
		{
			return $this->children[$key];
		}
		return null;

	}
	public function removeChild($key)
	{
		if(array_key_exists($key,$this->children))
		{
			unset($this->children[$key]);
		}
		return $this;
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