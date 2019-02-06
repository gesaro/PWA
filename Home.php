<?php

require 'Main.php';

class Home extends Main {
	
	public function __construct() {
		// Code
	}

	public function load() {
		$this->loadView('main');
	}

}

?>