<?php

class AttributeGrouperActivator extends Moderator{

	public function __construct()
	{
		parent::__construct();
		add_action('admin_menu',[$this,'addGroupsPage']);

		add_filter( "the_content", [$this,'displayAttributes'] );

	}


	public function displayAttributes(){
		if (is_single()) {  
			$attributes = (new Attribute)->getPostAttributes(get_the_ID());
			$html  = "<ul>";
			foreach ($attributes as $attribute) {
				$html  .= "<li> <a href=".$attribute->url.">$attribute->name</li>";
			}
			$html .= "</ul>";
		return $html;
		}
		return get_the_content();
		}

	public function activate() {
		
		$this->createTables();
		flush_rewrite_rules();
	}

	public function addGroupsPage(){
		$pageTitle="Attribute Grouper";
		$menu_title="Attribute";
		$capability="edit_theme_options";
		$menuSlug="attribute_grouper";

		add_menu_page($pageTitle,$menu_title,$capability,$menuSlug,[$this,'groupView'],'dashicons-groups',111);
	
	}

	public function groupView(){
		 $this->render('view');
	}
}