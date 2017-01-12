<?php

class UsersController extends AppController {
	public function initialize() {
		$this->{$this->modelAccessor}->bindModel("hasOne", "Post");
	}

	public function index() {
		$users = $this->Users->all();

		var_dump($users);
	}
}
