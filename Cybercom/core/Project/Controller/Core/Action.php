<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action {


	protected $view = null;

	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

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