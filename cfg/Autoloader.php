<?php

class Autoloader {
	private $directories = [];
	private $extensions = [];

	public function __construct(array $directoriess, array $extensions) {
		$this->directories = $directories;
		$this->extensions = $extensions;

		$this->register();
	}

	private function register() {
		$directories = array_merge((array)get_include_path(), $this->directories);
		$extensions = implode(",", $this->extensions);

		set_include_path(implode(PATH_SEPARATOR, $directories));

		spl_autoload_extensions($extensions);
		spl_autoload_register();
	}
}
