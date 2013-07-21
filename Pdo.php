<?php
namespace AI;

class Pdo{
	protected $_pdo;
	public static function getInstance()
	{
		if (null == self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function __construct(){
		$dsn = "mysql:host=".HOST.";dbname=".DB_NAME;
		$this->_pdo = new \PDO($dsn,USER_NAME,PASS_WORD, array(\PDO::ATTR_PERSISTENT => true));
	}
	public function getPdo(){
		return $this->_pdo;
	}
}
?>