<?php

class Model {
	public $hasTable = true;

	public $tableClass = null;

	public $table = null;

	public function __construct($modelName) {
		// Load table
		if($this->hasTable)) {
			if(is_null($this->tableClass)) {
				$tableName = $modelName . "sTable";
			} else {
				$tableName = $this->tableClass;
			}

			$tableClass = class_exists($tableName) ? $tableName : $defaults["tableClass"];

			$this->table = new $tableClass($tableName);
			$this->tableClass = $tableClass;
		}
	}
}
