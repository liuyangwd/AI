<?php
namespace AI;
class Request{
	protected $_request;
	protected $_server;
	protected $_post;
	protected $_get;
	protected $_cookie;
	protected $_requestUri;
	protected $_args = array();
	protected static $_instance;
	
	public function getRequest() {
		return $this->_request;
	}

	public function getServer($key = NULL) {
		if(isset($this->_server[$key]))return $this->_server[$key];
		else return $this->_server;
	}
	
	public function getRequestUri(){
		return $this->_requestUri;
	}
	public function setRequestUri($requestUri){
		$this->_requestUri = $requestUri;
	}
	public function getPost($key = NULL) {
		if(isset($this->_post[$key]))return $this->_post[$key];
		else return $this->_post;
	}

	public function getGet($key = NULL) {
		if(isset($this->_get[$key]))return $this->_get[$key];
		else return $this->_get;
	}

	public function getCookie($key = NULL) {
		if(isset($this->_cookie[$key]))return $this->_cookie[$key];
		else return $this->_cookie;
	}

	public function getArgs($key = NULL) {
		if(isset($this->_args[$key]))return $this->_args[$key];
		else return $this->_args;
	}
	
	public function setServer($_server) {
		$this->_server = $_server;
	}
	
	public function setRequest($_request) {
		$this->_request = $_request;
	}
	public function setPost($_post) {
		$this->_post = $_post;
	}

	public function setGet($_get) {
		$this->_get = $_get;
	}

	public function setCookie($_cookie) {
		$this->_cookie = $_cookie;
	}

	public function setArgs() {
		$requestUri = $this->_server['REQUEST_URI'];
		$requestUriArray = explode('?',$requestUri);
		$requestUri = $requestUriArray[0];
		$requestUriArray = explode('!',$requestUri);
		if(!empty($requestUriArray[1])){
			$args = explode('/',$requestUriArray[1]);
			$this->_args = $args;
		}
	}

	public static function getInstance()
	{
		if (null == self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function __construct()
	{
		$this->_request = $_REQUEST;
		$this->_post = $_POST;
		$this->_get = $_GET;
		$this->_cookie = $_COOKIE;
		$this->_server = $_SERVER;
		$this->setArgs();
		$this->_requestUri = $this->_server['REQUEST_URI'];
	}
	public function getMethod()
	{
		return $this->getServer('REQUEST_METHOD');
	}
	
	
}
?>