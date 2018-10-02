<?php namespace AG\Includes;

use AG\Includes\Files;

class Language{

	public function __construct() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
    }
    
    public function setLanguage($lang){

		$_SESSION['lang'] = (new Files)->loadLangFile(substr($lang,0,2));	
    }
    
    public static function lang($lang){

    	return $_SESSION['lang']["$key"];
    }
}