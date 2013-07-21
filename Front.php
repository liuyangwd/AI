<?php
namespace AI;

class Front{
	protected $_request;
	protected $_response;
	protected $_router;
	protected $_dispatcher;
	protected $_pdo;
	public function __construct(){
		$this->_request = new Request();
		$this->_response = new Response();
		$this->_router = new Router();
		$this->_dispatcher = new Dispatcher();
		$this->_pdo = new Pdo();
	}
	public function run(){
		
		$this->_dispatcher->dispatch();
		//$content = ob_get_contents();
		//$this->_response->write($content);
	}
}
?>