<?php

interface RepositoryInterface {
	public function insert($table, array $data = []);

	public function select($table, $fields, array $where = []);

	public function delete($table, array $where = []);

	public function rowCount();

	public function fetch();

	public function fetchAll();

	public function setMode($mode, $class = null);

	public function describe($table);
}
