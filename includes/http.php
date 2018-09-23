<?php

$formValidation = new Validator();

if(isset($_POST['delete'])){

	$formValidation->isIsset($_POST,['attributeID']);
	$attribute = new Attribute();
	$attribute->id = $_POST['attributeID'];
	$attribute->delete();
}

else if(isset($_POST['update'])){
	
	$formValidation->isIsset($_POST,['name','url','attributeID','overview']);
	$formValidation->isString($_POST['name']);
	$formValidation->isUrl($_POST['url']);
	$formValidation->isString($_POST['overview']);


	if(!$formValidation->hasErrors()){

		$attribute = new Attribute();
		$attribute->name = $_POST['name'];
		$attribute->url = $_POST['url'];
		$attribute->overview = $_POST['overview'];
		$attribute->categories = $_POST['categories'] ?? [];

		$attribute->categories($_POST['categories']??[])->update($_POST['attributeID']);

		echo '<div class="updated notice">Attribute updated successfully!.</div>';

	}else{
	
		foreach ($formValidation->errors as $error) {
				echo "<div class='error notice'>$error</div><br/>";
		}
	}

}

else if(isset($_POST['create_attribute'])){

	$formValidation->isIsset($_POST,['name','url','overview']);
	$formValidation->isString($_POST['name']);
	$formValidation->isUrl($_POST['url']);
	// $formValidation->isString($_POST['overview']);
	$path = $formValidation->uploaded('logo');
	$formValidation->isUnique($_POST['name'],Attribute::class,'name');



	if(!$formValidation->hasErrors()){

		$attribute = new Attribute();
		$attribute->name = $_POST['name'];
		$attribute->url = $_POST['url'];
		$attribute->logo = $path;
		$attribute->overview = $_POST['overview'];

		$attribute->categories($_POST['categories'])->save();

				echo '<div class="updated notice">Attribute added successfully!.</div>';

	}else{
	
		foreach ($formValidation->errors as $error) {
				echo "<div class='error notice'>$error</div><br/>";
		}
	}
}


class Validator{

	private $data = [];
	public $errors = [];


	public function uploaded($fileName){

	
		if ( $this->has_files_to_upload( $fileName ) ) {
		
			if ( isset( $_FILES['logo'] ) ) {
		
			   	$uploaded=media_handle_upload($fileName, 0);
		        $path = wp_get_attachment_url($uploaded);

		        $file = wp_upload_bits( $_FILES[$fileName]['name'], null, @file_get_contents( $_FILES[$fileName]['tmp_name'] ) );

		        // Error checking using WP functions
		        if(is_wp_error($uploaded)){
		                $this->errors[] = "Error uploading file: " . $uploaded->get_error_message();
		        }else{
		        		echo '<div class="updated notice">File upload successful!.</div>';
	
		        }

		        return $path;
			}
			return;
		}
		$this->errors[] = "No file uploaded";
	}

	public function has_files_to_upload() {

		return ( ! empty( $_FILES ) );
	}

	public function isIsset($request,$fields){
		foreach ($fields as $field) {
			if(!$request[$field]){
				$this->errors[] ="The $field is required.";
			}
		}
	}
	
	public function isInteger($integer){
		
		if(!is_integer($integer)) $this->errors[] ="Invalid integer.";

		return ;
	}

	public function isUnique($name,$model,$attributeName){
		global $wpdb;
		
		$instance = new $model();
		
		$count = $wpdb->get_var("SELECT COUNT(*) FROM $instance->tableName WHERE $attributeName = '".$name."';");

		if($count > 0){

			$this->errors[] ='The name exists in the database.';
			return;
		}
	}

	public function isUrl($url){
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
		
		  $this->errors[] ='Invalid URL or Website link';
		  return;
		}
	}

	public function isString($name){
		$name  = trim($name);
		if(!preg_match("/^[a-zA-Z'-]+$/",$name)) { 

			$this->errors[] ='Invalid name format';
			return;
		}
	}

	public function hasErrors(){
		
		return !empty($this->errors);
	}
}