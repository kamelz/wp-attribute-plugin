<?php

class AttributeGrouperActivator extends Moderator{

	public function __construct()
	{
		parent::__construct();
		add_action('admin_menu',[$this,'addGroupsPage']);
	}

	public function activate() {
		
		$this->createTables();
		flush_rewrite_rules();
	}

	public function addGroupsPage(){
		$pageTitle="Attribute Grouper";
		$menu_title="Groups";
		$capability="edit_theme_options";
		$menuSlug="attribute_grouper";

		add_menu_page($pageTitle,$menu_title,$capability,$menuSlug,[$this,'groupView'],'dashicons-groups',111);
	}

	public function groupView(){

	}

}