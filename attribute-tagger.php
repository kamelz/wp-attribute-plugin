<?php

/**
 * @package           Attribute-tagger
 *
 * @wordpress-plugin
 * Plugin Name:       Attribute tagger
 * Plugin URI:        http://example.com/attribute-tagger
 * Description:       Create attributes and group them by a name to display them in a post/page.
 * Version:           1.0.0
 * Author:            Mohamed Kamel
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       attribute-tagger
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
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

