<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
*/ 
class Core {
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];

	public function __construct(){
		//print_r($this->getUrl());
		
		$url = $this->getUrl();

		// Look in the controllers for first value
		if(file_exists('../app/controllers/' . $url[0] . '.php')) {
			// if exists, set as controller
			$this->currentController = ucwords($url[0]);
			
			// Unset 0 index
			unset($url[0]);
		}

		// Require the controller
		require_once '../app/controllers/'.$this->currentController.'.php';

		// Instantiate controller classs
		$this->currentController = new $this->currentController;

		// Check the second part of URL
		if(isset($url[1])) {
			// Check to see if method exists in controller
			if(method_exists($this->currentController, $url[1])) {
				$this->currentMethod = $url[1];
				// unset index 1
				unset($url[1]);
			}
		}
		//echo $this->currentMethod;

		// Get params [if parms added krijo array me parametra nese jo le empty]
		$this->params = $url ? array_values($url) : [];
		

		// Call a callback with array of parms
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		

		/*
		THIS CODE: INSTEAD OF USING CALLBACK:
		$currentC = new $this->currentController();
		$defaultFunction = $this->currentMethod;
		
		if($defaultFunction != 'index') {
			foreach($this->params as $param) {
				$currentC->$param();
			}
		} else {
			$currentC->$defaultFunction();
		}
		**/
	}

	public function getUrl() {
		if(isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL); //doents allow any character that URL shouldn't have.
			$url = explode('/', $url);
			return $url; // return url array
		}
	}
}