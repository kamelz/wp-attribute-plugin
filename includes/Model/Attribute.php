<?php

class Attribute extends BaseModel{
	
	public $name;
	public $url;
	public $logo;
	public $relationTable;
	public $hasCategory = false;

	public function __construct()
	{	
		parent::__construct();
		$this->tableName = $this->db->prefix.'attributes_grouper_attributes';
		$this->relationTable = $this->db->prefix.'attributes_grouper_attribute_category';
	}

	public function categories($categories){
		$this->hasCategory = true;
		$this->categories = $categories;
		return $this;
	}

	public function create(){
		
		if($this->exists()) return;

		$query = "CREATE TABLE $this->tableName ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `url` VARCHAR(255) NOT NULL , `logo` VARCHAR(255) NOT NULL , `overview` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

		dbDelta($query);
	}

		public function save(){

		$this->db->insert($this->tableName,$this->payload());
		if(!$this->hasCategory){return;}

		$attributeId = $this->db->insert_id;
		foreach ($this->categories as $category) {
			$this->db->insert($this->relationTable,[
				'attribute_id' => $attributeId ,
				'category_id' => $category,
			]);			
		}
	}

	public function payload(){

		return [
			'name' => $this->name,
			'url' => $this->url,
			'logo' => $this->logo,
			'overview' => $this->overview,
		];
	}

	public function update(){
		
		$this->db->update($this->tableName,['name' => $this->name],['id' => $this->id]);
	}


	public function render(){
		$attributes = $this->db->get_results("SELECT * FROM $this->tableName where 1;");
		$template = "";
		$counter = 0;
		foreach ($attributes as $attribute) {
			$stripedClass = $counter %2 == 0 ?'alternate':'';
			$counter++;
			$updateForm = "<form method='POST' action=''>";
			$updateForm .= "<input type='text' name='name' value=$attribute->name />";
			$updateForm .= "<input type='hidden' name='id' value=$attribute->id />";
			$updateForm .= "<input type='hidden' name='update_attribute'/>";
			$updateForm .= "</form>";

			$template .= "<tr class=$stripedClass>";
			$template .= "<td class='author column-author'> $attribute->id </td>";
			$template .= "<td class='author column-author'> $updateForm </td>";
			$template .= "</tr>";
		}
	
		echo $template;
	}
}