<?php
namespace AI;

class Model{
	protected $_tableName;
	protected $_primaryKey = 'id';
	protected $_data = array();
	protected $_pdo;
	protected static $_instance;
	public function __construct($data = NULL, $tableName = NULL, $primaryKey = NULL){
		$tableName1 = explode('/',get_class($this));
		$tableName1 = $tableName1[1];
		if($tableName == NULL)$this->_tableName = $tableName1;
		else $this->_tableName = $tableName;
		if($primaryKey != NULL)$this->_primaryKey = $primaryKey;
		$this->_data = $data;
		$this->_pdo = Pdo::getInstance()->getPdo();
	}
	public function fetchAll($where = NULL, $data = NULL){
		$sql = "select * from ".$this->_tableName." where ".$where;
		$sth = $this->_pdo->prepare($sql);
		if($data == NULL)$sth->execute($this->_data);
		else $sth->execute($data);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$rs = $sth->fetchAll();
		return $rs;
	}
	public function query($sql){
		return $this->_pdo->query($sql);
	}
	public function insert($data = NULL){
		if($data == NULL)$data1 = $this->_data;
		else $data1 = $data;
		$sql = "insert into ".$this->_tableName." set ";
		foreach($data1 as $k => $v){
			$sql .= $k. "='".$v."',";
		}
		$sql = substr($sql, 0, -1);
		$sth = $this->_pdo->prepare($sql);
		$sth->execute();
		return $this->_pdo->lastInsertId();
	}
	public function quote($sql){
		
	}
	public function update($set = NULL, $where = NULL){
		if($set == NULL)$set = $this->_data;
		$sql = "update ".$this->_tableName." set ";
		foreach($set as $k => $v){
			$sql .= $k. "='".$v."',";
		}
		$sql = substr($sql, 0, -1);
		if($where != NULL){
			$sql .= " where ".$where;
		}
		$sth = $this->_pdo->prepare($sql);
		$sth->execute();
	}
	public function save(){
		$data = $this->_data;
		if(empty($data[$this->_primaryKey])){
			$this->insert($data);
		}
		else{
			$where = $this->_primaryKey."="."'".$data[$this->_primaryKey]."'";
			$this->update($data,$where);
		}
	}
	public function find($id){
		return $this->fetchAll("'id = id",array('id'=>$id));
	}
}
?>