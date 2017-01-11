<?php

class View {
	public $page;
	public $action;
	public $vars = array();

	public function __construct($page, $action) {
		$this->page = $page;
		$this->action = $action;
	}

	public function set($name, $value) {
		$this->vars[$name] = $value;
	}

	public function render() {
		extract($this->vars);

		// Render header, body, footer
	}
}
