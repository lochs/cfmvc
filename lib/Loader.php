<?php

class Loader
{
	private $instances = [];

	public function load($class, array $args = []) {
		if(array_key_exists($class, $this->instances)) {
			return $this->instances[$class];
		}

		if(empty($args)) {
			$instance = new $class;
		} else {
			$instance = new $class(...$args);	// Argument unpacking
		}

		$this->instances[$class] = $instance;

		return $instance;
	}

}
