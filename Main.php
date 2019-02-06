<?php

class Main {
	
	public function __construct() {
		// Code
	}

	protected function loadView($view) {
		$path = 'Resources/Views/'.$view.'.php';
		
		if(file_exists($path)) {
			include $path;
		} else {
			include 'Resources/Views/Errors/error404.html';
		}
	}

}

?>