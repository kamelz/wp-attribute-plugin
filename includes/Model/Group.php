<?php

class Group extends BaseModel{
	
	public function __construct()
	{	
		parent::__construct();
		$this->tableName = $this->db->prefix.'attributes_grouper_groups';
	}

	public function create(){
		
		if($this->exists()) return;

		$query ="CREATE TABLE $this->tableName ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` INT(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

		dbDelta($query);
	}
}
