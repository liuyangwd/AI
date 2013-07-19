<?php
namespace AI;
class Controller{
	public $view;
	public function __construct(){
		$this->view = new View();
	}
	
	public function render(){
		$this->view->render();
	}
	
	public function redirect($url)
    {
        header("Location: $url");
        exit();
    }
	public function run(){
		
	}
}
?>