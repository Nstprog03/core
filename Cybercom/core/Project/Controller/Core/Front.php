<?php 
Ccc::loadClass('Model_Core_Request');
class Controller_Core_Front
{
	protected $request = null;
	public function getRequest()
	{
		if(!$this->request)
		{
			$request = new Model_Core_Request();
			$this->setRequest($request);
		}
		return $this->request;
	}

	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}

	public function init()
	{
		$request = new Model_Core_Request();
		$actionName = $request->getActionName();
		$controllerName = $request->getControllerName();
		$controllerClassName = 'Controller_'.$controllerName;
		$controllerClassName = $this->prepareClassName($controllerClassName);
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}

	public function prepareClassName($name)
	{
		$name = ucwords($name,"_");
		return $name;
	}
}

?>