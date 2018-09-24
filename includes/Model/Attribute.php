<?php

class Attribute extends BaseModel{
	
	public $name;
	public $url;
	public $logo;
	public $relationTable;
	public $categories;
	public $hasCategory = false;

	public function __construct()
	{	
		parent::__construct();
		$this->tableName = $this->db->prefix.'attributes_grouper_attributes';
		$this->relationTable = $this->db->prefix.'attributes_grouper_attribute_category';
	}

	public function all(){
		$query = "Select * from $this->tableName;";

		return $this->db->get_results($query);
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

	public function delete(){

		$this->db->delete($this->tableName,['id' => $this->id]);
		$this->db->delete($this->relationTable,['attribute_id' => $this->id]);
	}
	public function update($attributeId){
		
		$this->sync($attributeId);
		$this->db->update($this->tableName,$this->payload(),['id' => $attributeId]);
	}

	public function sync($attributeId){
		$query = "DELETE FROM $this->relationTable WHERE `attribute_id` = $attributeId";

	$this->db->query($query);

	foreach ($this->categories as $category) {
			$this->db->insert($this->relationTable,[
				'attribute_id' => $attributeId ,
				'category_id' => $category,
			]);	
		}
	}

	public function getPostAttributes($postID){
		$attributes = [];
		$uniqueAttributes = [];
		$categoreis = wp_get_post_categories($postID);

		foreach($categoreis as $category){
			$query = "SELECT * FROM $this->tableName as `a` join $this->relationTable as `ac` WHERE `a`.id = `ac`.attribute_id AND `ac`.category_id = $category ORDER by `ac`.category_id"; 
			$attributes[] = $this->db->get_results($query);
		}
		
		for($i = 0; $i<count($attributes); $i++){
			foreach ($attributes[$i] as $attribute) {
				$uniqueAttributes[$attribute->attribute_id] = $attribute;

			}
		}

		return $uniqueAttributes;
	}

	public function getAttributes(){
		
		$query = "SELECT * FROM $this->tableName where 1"; 
	
		return $this->db->get_results($query);
	}
	
	public function getAttributeCategories($attributeId){
		$query = "select * from $this->relationTable where `attribute_id` = $attributeId";
		return  $this->db->get_results($query);
	}

	public function render(){
 		$attributes = (new Attribute)->getAttributes();
		$template = "";
		$counter = 0;

		$allCategories = get_categories(['exclude'=>1 ,'hide_empty' => FALSE]);
		foreach ($attributes as $attribute) {
			$attributeCategories = [];
 			foreach ($this->getAttributeCategories($attribute->id) as $category) {
 				$attributeCategories [] = (array)$category;
 			}
 		
 			$categoriesSelectBox  = "<select name='categories[]' multiple>";
 			foreach ($allCategories as $category) {
 				$inArray = false;
 				foreach ($attributeCategories as $key => $value) {
 					if(in_array($category->term_id,$value)){
 						$inArray = true;
 					}
 				}
 				if($inArray){

 					$categoriesSelectBox .= "<option selected value=$category->term_id > $category->name </option>";				
 				}else{
 			
 					$categoriesSelectBox .= "<option value=$category->term_id > $category->name </option>";				
 				}
 			}

 			$categoriesSelectBox .= "</select>";

			$stripedClass = $counter %2 == 0 ?'alternate':'';

			$template .= "<tr class=$stripedClass>";
			$template .= "<form method='POST' action=''>";
			$template .= "<input type='hidden' name='attributeID' value=$attribute->id />";
			$template .= "<td class='author column-author'> <img class='attachment-60x60 size-60x60' height='60' width='60'  src='$attribute->logo' /></td>";
			$template .= "<td class='author column-author'> <input type='text' name='name' value=$attribute->name /> </td>";
			$template .= "<td class='author column-author'> <input type='text' name='url' value=$attribute->url /></td>";
			$template .= "<td class='author column-author'> <textarea name='overview' >$attribute->overview </textarea> </td>";
			$template .= "<td class='categories-select author column-author'> $categoriesSelectBox </td>";
			$template .= "<td class='author column-author'> <input type='submit' name='delete' class='delete-btn' value='Delete'/> <input class='update-btn' type='submit' name='update' value='Update'/>  </td>";
			$template .= "</tr>";
			$template .= "</form>";
			$counter++;
		}
	
		echo $template;
	}
}