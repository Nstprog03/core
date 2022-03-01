<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action {

	protected $layout = null;
	protected $view = null;

	public function redirect($url)
	{
		header("Location: $url");
		exit();
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
	public function renderLayout()
	{
		return $this->getLayout()->toHtml();
	}
	// when Layout is done View will be deleted; 
	public function getView()
	{
		if (!$this->view)
		{

			$this->setView(new Model_Core_View());
		}
		return $this->view;
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
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