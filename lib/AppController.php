<?php

class AppController extends Controller {
	protected $loader;

	public function __construct(Request $request) {
		$this->loader = new Loader();

		parent::__construct($request);
	}
}
