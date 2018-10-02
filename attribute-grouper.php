<?php namespace AG;

require_once 'vendor/autoload.php';

/**
 * @package           Attribute grouper
 *
 * @wordpress-plugin
 * Plugin Name:       Attribute grouper
 * Plugin URI:        http://example.com/attribute-grouper
 * Description:       Create attributes and group them by a name to display them in a post/page.
 * Version:           1.0.0
 * Author:            Mohamed Kamel
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       attribute-grouper
 * Domain Path:       /languages
 */

use AG\Includes\Bootstrap;

class AttributeGrouperMain{

	function __construct()
	{ 
		if(!$this->isWordPress()) die;

		define( 'ATTRIBUTE_TAGGER_VERSION', '1.0.0' );
		
		$this->bootstrap();
	}

	/**
	 * Register the plguin assets and shortcodes.
	 * @param  Bootstrap $app          
	 */
	public function bootstrap(){
		
		$app = new Bootstrap();

		$app->registerActivationHook();
		$app->registerDeactivationHook();
	}

	/**
	 * If this file is called directly, abort.
	 * @return bool 
	 */
	public function isWordPress(){

		return defined( 'ABSPATH' );
	}	
}
(new AttributeGrouperMain());


// require_once plugin_dir_path( __FILE__ ) . 'loader.php';


if(class_exists('AttributeGrouperActivator')){
	$activator = new AttributeGrouperActivator();
}


	
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-attribute-grouper-deactivator.php
 */
function deactivate_attribute_grouper() {
	(new AttributeGrouperDeactivator)->deactivate();
}


