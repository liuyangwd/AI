<?php
namespace AI;
class Layout{
	protected $_layoutName = "layout";
	public $content;
	protected static $_instance;
	public static function getInstance()
	{
		if (null == self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function render(){
		include APPLICATION_PATH."/layout/"."$this->_layoutName".".php";
		
	}
	public function getLayoutName() {
		return $this->_layoutName;
	}

	public function getContent() {
		return $this->content;
	}

	public function setLayoutName($_layoutName) {
		$this->_layoutName = $_layoutName;
	}

	public function setContent($content) {
		$this->content = $content;
	}
	public function __get($layoutName){
		if($layoutName == "content"){
			return $this->getContent();
		}
		else{
			include APPLICATION_PATH."/layout/"."$layoutName"."php";
		}
	}
	
}
?>