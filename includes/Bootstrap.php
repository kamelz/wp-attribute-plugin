<?php namespace AG\Includes;

use AG\Includes\Files;
use AG\Includes\Language;
use AG\Includes\ShortcodeHandler;
use AG\Includes\AttributeGrouperActivator;
use AG\Includes\AttributeGrouperDeactivator;

class Bootstrap{

	public function __construct() {

		(new Language)->setLanguage(get_locale());
		(new AttributeGrouperActivator());
    }
    
    public function registerActivationHook(){
    	register_activation_hook( __FILE__, [$this,'activateAttributeGrouper'] );
	}

	public function registerDeactivationHook(){
		register_deactivation_hook( __FILE__, [$this,'deactivateAttributeGrouper'] );
	}
	
	public function activateAttributeGrouper(){
		
		if (!current_user_can('edit_posts'))
		{
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		(new AttributeGrouperActivator)->activate();
	}
	
	public function deactivateAttributeGrouper(){

		(new AttributeGrouperDeactivator)->deactivate();
	}

}