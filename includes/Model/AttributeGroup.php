<?php

class AttributeGroup extends BaseModel{
	
	public function __construct()
	{	
		parent::__construct();
		$this->tableName = $this->db->prefix.'attributes_grouper_attribute_group';
	}


	public function create(){
		
		if($this->exists()) return;
		$query ="CREATE TABLE $this->tableName ( `id` INT(11) NOT NULL AUTO_INCREMENT , `attribute_id` INT(11) UNSIGNED NOT NULL , `group_id` INT(11) UNSIGNED NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

		dbDelta($query);
	}
}
