<?php

class Attribute extends BaseModel{
	
	public function __construct()
	{	
		parent::__construct();
		$this->tableName = $this->db->prefix.'attributes_grouper_attributes';
	}

	public function create(){
		
		if($this->exists()) return;

		$query = "CREATE TABLE $this->tableName ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `url` VARCHAR(255) NOT NULL , `logo` VARCHAR(255) NOT NULL , `overview` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

		dbDelta($query);
	}
}