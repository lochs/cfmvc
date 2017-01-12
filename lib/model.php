<?php

class Model {
	public $hasTable = true;

	// Model's primary table class name
	public $tableClass = null;

	// Model's primary table instance
	public $table = null;

	// Model name
	protected $modelName;

	// Array of associations for this model
	protected $associations = [];

	public function __construct($modelName) {
		$defaults = Config::getConfig("Defaults");

		$this->modelName = $modelName;

		// Load table
		if($this->hasTable) {
			if(is_null($this->tableClass)) {
				$tableName = $modelName . "sTable";
			} else {
				$tableName = $this->tableClass;
			}

			$tableClass = class_exists($tableName) ? $tableName : $defaults["tableClass"];

			$this->table = new $tableClass($tableName);
			$this->tableClass = $tableClass;
		}

		// Hook for per-model init code
		$this->initialize();
	}

	public function initialize() {
		// Per-model init code
	}

	public function all() {
		$data = [];
		$data[$this->modelName] = $this->table->all();

		if(!empty($this->associations["hasOne"])) {
			foreach($this->associations["hasOne"] as $index => $accessor) {
				$data[$accessor] = $this->$accessor->all();
			}
		}

		if(count($data) <= 1) {
			return $data[$this->modelName];
		} else {
			return $data;
		}
	}

	public function first() {
		$data = [];
		$data[$this->modelName] = $this->table->first();
		if(!empty($this->associations["hasOne"])) {
			foreach($this->associations["hasOne"] as $index => $accessor) {
				$data[$accessor] = $this->$accessor->first();
			}
		}

		if(count($data) <= 1) {
			return $data[$this->modelName];
		} else {
			return $data;
		}
	}

	public function bindModel($type, $model) {
		$this->associations[$type][] = $model;

		$this->$model = Loader::loadModel($model);
	}

	protected function getRelations() {
	}
}
