<?php

class Request {
	public $page;
	public $action;
	public $args = [];

	public function __construct() {
		$defaults = Config::getConfig("Defaults");

		if(!isset($_GET["url"])) {
			$this->page = $defaults["page"];
			$this->action = $defaults["action"];
		} else {
			$this->parse($_GET["url"], $defaults);
		}
	}

	private function parse($url, $defaults) {
		$urlArray = [];
		$urlArray = explode("/", $url);

		$this->page = empty($urlArray[0]) ? $defaults["page"] : $urlArray[0];
		array_shift($urlArray);

		$this->action = empty($urlArray[0]) ? $defaults["action"] : $urlArray[0];
		array_shift($urlArray);

		$this->args = $urlArray;
	}
}
