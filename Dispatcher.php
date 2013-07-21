<?php
namespace AI;
class Dispatcher{
	protected $_request;
	protected $_router;
	public function __construct(){
		$this->_request = Request::getInstance();
		$this->_router = Router::getInstance();
	}
	public function dispatch(){
		$uri = $this->_request->getRequestUri();
		if($uri == "/"){
			$this->_request->setRequestUri("/main/main");
			$this->_router->route();
			
		}
		$controllerPath = $this->_router->getControllerPath();
		
		if(!file_exists($controllerPath)){
			header('location:/error.php');
			exit();
		}
		
		$controllerName = $this->_router->getControllerName();
		$controllerName = '\\'.$controllerName;
		include $controllerPath;
		$controller = new $controllerName();
		
		$controller->run();
		$controller->render();
	}
}
?>