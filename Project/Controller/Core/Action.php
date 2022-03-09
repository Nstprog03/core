<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action {

	protected $layout = null;
	protected $view = null;
	protected $message = null;
	
	public function redirect($a=null,$c=null,array $data = [],$reset = false)
    {
        $url = Ccc::getModel('core_view')->getUrl($a,$c,$data,$reset);
        header("location: $url");
    }

	public function getLayout()
	{
		if(!$this->layout)
		{
			$this->setLayout(Ccc::getBlock('Core_Layout'));
		}
		return $this->layout;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getMessage()
	{
		if(!$this->message)
		{
			$this->setMessage(Ccc::getModel('Core_Message'));
		}
		return $this->message;
	}

	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	public function renderLayout()
	{
		return $this->getLayout()->toHtml();
	}
	public function getAdapte()
	{
		global $adapter;
		return $adapter;
	}
	public function getRequest()
	{
		return Ccc::getFront()->getRequest(); 
	}
		
}