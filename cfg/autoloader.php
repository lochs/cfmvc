<?php

class Autoloader {
	private $directories = [];
	private $extensions = [];

	public function __construct(array $directories, array $extensions) {
		$this->directories = $directories;
		$this->extensions = $extensions;

		$this->register();
	}

	private function register() {
		$extensions = implode(",", $this->extensions);

		set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $this->directories));

		spl_autoload_extensions($extensions);
		spl_autoload_register();

		// Register dummy autoload function to prevent
		// class_exists() from throwing exceptions
		spl_autoload_register(function(){});
	}
}
