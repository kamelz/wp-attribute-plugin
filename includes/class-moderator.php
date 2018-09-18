<?php

class Moderator{
	
	public $db;
	
	public $models = [
		'Attribute',
		'Group',
		'AttributeGroup'
	];
	public $baseModel;

	public function __construct()
	{
		global $wpdb;
		$this->db = $wpdb;
		$this->baseModel = new BaseModel();
		
	}

	protected function createTables(){
		// todo check if there is a backup, if so, import from it.
		$this->db->show_errors = false;
		$this->baseModel->init($this->models);
		$this->db->show_errors = true;
	}
	

	protected function dropTables(){

		$this->baseModel->drop($this->db->prefix.'attributes_grouper_attributes');
		$this->baseModel->drop($this->db->prefix.'attributes_grouper_groups');
		$this->baseModel->drop($this->db->prefix.'attributes_grouper_attribute_group');
	}
}