<?php

class Controller
{
	// Request object containing all request data
	public $request;

	// Instance of the view class
	public $view;

	// Flag to determine whether current page uses a model
	public $useModel = true;

	// Model accessor
	public $modelAccessor;

	public function __construct(Request $request) {
		$this->request = $request;

		// Load model
		if($this->useModel) {
			$defaults = Config::getConfig("Defaults");

			// Model naming convention: User
			$modelName = Inflector::singularize($this->request->page, true);

			// Model access from controller e.g. $this->Users
			$modelAccessor = ucwords($this->request->page);	

			// Instantiate new model
			$this->$modelAccessor = Loader::loadModel($modelName);

			$this->modelAccessor = $modelAccessor;
		}

		// Load view
		$this->view = new View($this->request->page, $this->request->action);

		// Hook for controller-specific init code
		$this->initialize();
	}

	public function initialize() {
		// Controller-specific init code
	}

	// Render view on exit
	public function __destruct() {
		$this->view->render();
	}

	protected function loadModel($model) {
		$modelAccessor = $model . "s";
		$this->$modelAccessor = Loader::loadModel($model);
	}
}
