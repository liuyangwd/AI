<?php
namespace AI;
include 'Config.php';


class Booter{
	public function autoload($className){
		$className = str_replace('\\', "/", $className);
		$classPath = $className.'.php';
		include $classPath;
		if((file_exists($classPath))){
			include $classPath;
		}
	}
	public function __construct(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
	public function run(){
		$front = new Front();
		$front->run();
	}
}
?>