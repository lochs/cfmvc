<?php

class Repository implements RepositoryInterface {

	protected $db;
	protected $stmt;

	protected $mode;
	protected $class = null;

	public function __construct() {
		$this->db = Database::getConnection();
	}

	public function insert($table, array $data = []) {
		$query = "REPLACE INTO " . $table;

		$query .= "(" . implode(",", array_keys($data)) . ")";
		$ph = implode(",", array_fill(0, count($data), "?"));
		$query .= " VALUES (" . $ph . ")";

		$this->stmt = $this->db->prepare($query);
		$this->stmt->execute(array_values($data));

		return $this->db->lastInsertId();
	}

	public function select($table, $fields, array $where = []) {
		if(is_array($fields))
			$fields = implode(",", $fields);

		$query = "SELECT " . $fields . " FROM " . $table;

		// Handle WHERE
		if(!empty($where))
			$query .= $this->buildWhere($where);

		$this->stmt = $this->db->prepare($query);
		$this->stmt->setFetchMode($this->mode, $this->class);

		$this->stmt->execute(array_values($where));

		return $this->rowCount();
	}

	public function delete($table, array $where = []) {
		$query = "DELETE FROM " . $table;

		if(!empty($where))
			$query .= $this->buildWhere($where);

		$this->stmt = $this->db->prepare($query);

		$this->stmt->execute(array_values($where));

		return $this->rowCount();
	}

	public function rowCount() {
		return $this->stmt->rowCount();
	}

	public function fetch() {
		return $this->stmt->fetch();
	}

	public function fetchAll() {
		return $this->stmt->fetchAll();
	}

	public function setMode($mode, $class = null) {
		switch($mode) {
		case "Class":
			$this->mode = PDO::FETCH_CLASS;
			$this->class = $class;
			break;
		case "Assoc":
			$this->mode = PDO::FETCH_ASSOC;
		}
	}

	public function describe($table) {
		$query = "DESCRIBE " . $table;
		$this->stmt = $this->db->prepare($query);
		$this->stmt->execute();

		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buildWhere(array $where = []) {
		$query = " WHERE";
		for($i = 0; $i < count($where); $i++) {
			$key = key($where);
			if($i > 0 && $i != count($where))
				$query .= " AND";

			$query .= " " . $key . " = ?";
			next($where);
		}

		return $query;
	}
}
