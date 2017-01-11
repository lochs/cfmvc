<?php

class Table {
	public $table = null;
	public $entityClass = null;

	public function __construct($tableName) {
		$defaults = Config::getConfig("Defaults");

		// Set table name
		if(is_null($table))
			$this->table = strtolower(substr($tableName, 0, -5));	// Lowercase + remove trailing "Table"

		// Set entity class
		if(is_null($this->entityClass))
			$this->entityClass = ucwords(rtrim($this->table, "s")) . "Entity";

		$this->entityClass = class_exists($this->entityClass) ? $this->entityClass : $defaults["entityClass"];
	}
}
