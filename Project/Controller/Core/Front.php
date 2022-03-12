<?php 
Ccc::loadClass('Model_Core_Response');
Ccc::loadClass('Model_Core_Request');
class Controller_Core_Front
{
	protected $request = null;
	protected $response = null;
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

	public function getResponse()
    {
        if(!$this->response)
        {
            $response = new Model_Core_Response();
            $this->setResponse($response);
        }
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

	public function init()
	{
		$request = $this->getRequest();
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