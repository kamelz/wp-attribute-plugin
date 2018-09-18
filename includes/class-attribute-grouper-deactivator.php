<?php

class AttributeGrouperDeactivator extends Moderator{

	public function __construct()
	{
		parent::__construct();
	}

	public function deactivate() {

		$this->dropTables();
		flush_rewrite_rules();
	}
}