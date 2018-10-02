<?php namespace AG\Includes\Model;

class BaseModel{

	public $db;
	public $model;
	public $tableName;
	public $hasWhere = false;
	public $where;

	public function __construct()
	{
		global $wpdb;
		$this->db = $wpdb;
	}

	public function init($models){
		foreach ($models as $model) {
			if(class_exists($model)){
				$instance = new $model;
				$instance->create();
			}
		}
	}

	protected function exists(){

		$query = "select 1 from $this->tableName";
		return $this->db->query($query) === FALSE ? 0:1;
	}

	public function drop($tableName){

		$query =" DROP TABLE IF EXISTS $tableName; ";		
		$this->db->query($query);
	}

	public function where($codition,$operator ="=",$value){
		$this->hasWhere = true;	
		$this->where = "where $codition $operator $value";
		return $this;
	}
}