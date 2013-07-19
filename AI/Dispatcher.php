<?php
namespace AI;
class Dispatcher{
	protected $_request;
	protected $_router;
	public function __construct(){
		$this->_router = Router::getInstance();
	}
	public function dispatch(){
		$controllerPath = $this->_router->getControllerPath();
		if(!file_exists($controllerPath)){
			header('location:/error.php');
			exit();
		}
		include $controllerPath;
		$controllerName = $this->_router->getControllerName();
		$controllerName = '\\'.$controllerName;
		$controller = new $controllerName();
		$controller->run();
		$controller->render();
	}
}
?>