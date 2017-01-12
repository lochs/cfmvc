<?php

class Table extends Repository {
	public $table = null;
	public $entityClass = null;
	
	public $schema = [];

	public function __construct($tableName) {
		parent::__construct();

		$defaults = Config::getConfig("Defaults");

		// Set table name
		if(is_null($this->table))
			$this->table = strtolower(substr($tableName, 0, -5));	// Lowercase + remove trailing "Table"

		// Set entity class
		if(is_null($this->entityClass))
			$this->entityClass = ucwords(rtrim($this->table, "s")) . "Entity";

		$this->entityClass = class_exists($this->entityClass) ? $this->entityClass : $defaults["entityClass"];

		// Set fetch mode
		$this->setMode("Class", $this->entityClass);

		// Get table fields
		$this->getSchema();
	}

	public function getSchema() {
		$schema = $this->describe($this->table);
		foreach($schema as $column) {
			$this->schema[] = $column["Field"];
		}
	}

	public function all() {
		$rows = $this->select($this->table, "*");
		if(!$rows)
			return false;

		return $this->fetchAll();
	}

	public function first() {
		$rows = $this->select($this->table, "*");
		if(!$rows)
			return false;

		return $this->fetch();
	}
}
