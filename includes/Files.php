<?php namespace AG\Includes;

class Files{

	public function __construct() {
		
		if(!defined('LANGS_PATH'))
			define('LANGS_PATH',plugin_dir_path(__FILE__).'lang');
    }

	public function loadLangFile($lang){
		
		return include LANGS_PATH.'/'.$lang.'.php';
	}

	
}