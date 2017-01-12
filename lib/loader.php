<?php

class Loader
{
	private static $models = [];

	private function __construct() { }

	public static function loadModel($model) {
		if(array_key_exists($model, self::$models)) {
			return self::$models[$model];
		}

		$defaults = Config::getConfig("Defaults");

		$modelClass = class_exists($model) ? $model: $defaults["model"];

		$instance = new $modelClass($model);

		// If we are not loading the default model
		// add the loaded model to the list
		// to prevent double loading
		if($modelClass != $defaults["model"])
			self::$models[$model] = $instance;

		return $instance;
	}

}
