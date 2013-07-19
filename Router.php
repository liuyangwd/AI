<?php
namespace AI;
class Router
{
	protected $_request;
	protected $_requestUri;
	protected $_controllerPath;
	protected $_controllerName;
	protected static $_instance;
	
	public static function getInstance()
	{
		if (null == self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function __construct(){
		$this->setRequest();
		$this->setRequestUri();
		$this->route();
	}
	public function getControllerPath() {
		return $this->_controllerPath;
	}

	public function getRequest() {
		return $this->_request;
	}

	public function getRequestUri() {
		return $this->_requestUri;
	}

	public function getControllerName() {
		return $this->_controllerName;
	}

	public function setRequest() {
		$this->_request = Request::getInstance();
	}

	public function setRequestUri() {
		$requestServer = $this->getRequest()->getServer();
		$this->_requestUri = $requestServer['REQUEST_URI'];
	}
	public function setControllerName($_controllerName) {
		$this->_controllerName = $_controllerName;
	}

	public function setControllerPath($_controllerPath) {
		$this->_controllerPath = $_controllerPath;
	}
	
	public function route(){
		$requestUri = $this->_requestUri;
		$requestUriArray = explode('?',$requestUri);
		$requestUri = $requestUriArray[0];
		$requestUriArray = explode('!',$requestUri);
		$requestUri = $requestUriArray[0];
		$controllerPath = APPLICATION_PATH.'/controllers'.$requestUri.'.php';
		$requestUriArray = explode('/',$requestUri);
		$controllerName = array_pop($requestUriArray);
		$this->setControllerName($controllerName);
		$this->setControllerPath($controllerPath);
		
	}
}
?>