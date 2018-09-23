<?php

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


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if(! function_exists('add_action')){
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ATTRIBUTE_TAGGER_VERSION', '1.0.0' );

require_once plugin_dir_path( __FILE__ ) . 'loader.php';


if(class_exists('AttributeGrouperActivator')){
	$activator = new AttributeGrouperActivator();
}

function activate_attribute_grouper() {

  if (!current_user_can('edit_theme_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

	(new AttributeGrouperActivator)->activate();
}
	
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-attribute-grouper-deactivator.php
 */
function deactivate_attribute_grouper() {
	(new AttributeGrouperDeactivator)->deactivate();
}



register_activation_hook( __FILE__, 'activate_attribute_grouper' );
register_deactivation_hook( __FILE__, 'deactivate_attribute_grouper' );
