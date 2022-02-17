<?php 

class Model_Core_Request
{
	public function getPost($key = null,$value = null)
	{
		if(!$this->isPost())
		{
			return null;	
		}
		if($key == null)
		{
			return $_POST;
		}
		if(!array_key_exists($key,$_POST))
		{
			return $value;
		}
		return $_POST[$key];
	}
	
	public function getRequest($key = null,$value = null)
	{
		if($key == null)
		{
			
			return $_REQUEST;
		}
		if(!array_key_exists($key,$_REQUEST))
		{

			return $value;
		}
		return $_REQUEST[$key];
	}
		

	public function ispost()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			return true;
		}
		return false;
	}

	public function getActionName()
	{
		return $this->getRequest('a','index').'Action';
		//$actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'error';
		//return $actionName;
	}

	public function getControllerName()
	{
		return $this->getRequest('c','customer');
		//$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer';
		//return $controllerName;
	}
}


$r = new Model_Core_Request()

?>