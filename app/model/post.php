<?php

class Post extends Model {
	public function initialize() {
		$this->bindModel("hasOne", "Profile");
	}
}

