<?php

class Controller
{
	// Request object containing all request data
	public $request;

	// Instance of the view class
	public $view;

	// Flag to determine whether current page uses a model
	public $useModel = true;

	public function __construct(Request $request) {
		$this->request = $request;

		// Load model
		if($this->useModel) {
			$defaults = Config::getConfig("Defaults");

			// Model naming convention: User
			$modelName = Inflector::singularize($this->request->page);
			$modelClass = class_exists($modelName) ? $modelName : $defaults["model"];

			// Model access from controller e.g. $this->Users
			$modelAccessor = ucwords($this->request->page);	

			// Instantiate new model
			$this->$modelAccessor = new $modelClass($modelName);
		}

		// Load view
		$this->view = new View($this->request->page, $this->request->action);
	}

	// Render view on exit
	public function __destruct() {
		$this->view->render();
	}
}
