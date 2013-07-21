<?php
namespace AI;
class View{
	protected $_layout;
	protected $_disableLayout = false;
	protected $_disableView = false;
	protected $_viewName = "default";
	protected $_viewPath;
	protected $_layoutName = "layout";
	protected $_router;
	
	private $_data = array();
	
	public function __set($key, $val)
	{
		$this->_data[$key] = $val;
	}
	
	public function __get($key)
	{
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}
	
	public function setView($viewName) {
		$this->_viewPath = str_replace("default", "$viewName", $this->_viewPath);
	}

	public function setLayout($_layoutName) {
		$this->_layoutName = $_layoutName;
		$this->_layout->setLayoutName($_layoutName);
	}

	public function __construct(){
		$this->_layout = Layout::getInstance();
		$this->_router = Router::getInstance();
		$controllerPath = $this->_router->getControllerPath();
		$find = array("controllers",".php");
		$replace = array("views","");
		$this->_viewPath = str_replace($find, $replace, $controllerPath).'/'.$this->_viewName.'.php';
		
	}
	public function disableLayout(){
		$this->_disableLayout = true;
	}
	public function disableView(){
		$this->_disableView = true;
	}
	public function render(){
		if($this->_disableView == true)return;
		ob_start();
		include $this->_viewPath;
		if (!$this->_disableLayout) {
			$content = ob_get_contents();
			$this->_layout->setContent($content);
			ob_clean();
			$this->_layout->render();
		}
		ob_flush();
	}
}	
?>