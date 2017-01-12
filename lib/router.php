<?php

class Router {
	public $request;

	private $controllerClass;
	private $controllerInstance;

	public function __construct() {
		$this->request = new Request();

		$this->validate();
		$this->dispatch();
	}

	// Controller/action validation
	private function validate() {
		$controller = ucwords($this->request->page) . "Controller";
		if(class_exists($controller)) {
			if(!method_exists($controller, $this->request->action))
				$this->setError();
		} else {
			$this->setError();
		}

		$this->controllerClass = ucwords($this->request->page) . "Controller";
	}

	// Set error request (for 404 etc.)
	private function setError() {
		$error = Config::getConfig("Error");

		$this->request->page = $error["page"];
		$this->request->action = $error["action"];
		$this->request->args = [];
	}

	// Handle control over to the controller
	private function dispatch() {
		$this->controllerInstance = new $this->controllerClass($this->request);
		call_user_func_array([$this->controllerInstance, $this->request->action], $this->request->args);
	}	
}
