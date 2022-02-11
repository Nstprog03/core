<?php require_once('Model/Core/Adapter.php');  ?>
<?php require_once('menu.php'); ?>
<?php 

class Ccc
{
	public static function loadFile($path)
	{
		require_once($path);
	}
	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}
	public static function init()
	{
		$actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'error';
		//$actionName = $actionName.'Action';
		$controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer';
		//$controllerPath = 'Controller/'.$controllerName.'.php';
		$controllerClassName = 'Controller_'.$controllerName;
		Ccc::loadClass($controllerClassName);
		$controller = new $controllerClassName();
		$controller->$actionName();
	}
}

Ccc::init();
?>