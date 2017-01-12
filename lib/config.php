<?php

class Config {
	private static $config = null;

	private function parse() {
		$path = "../cfg/config.ini";
		self::$config = parse_ini_file($path, true);
	}

	public static function getConfig($config) {
		if(is_null(self::$config))
			self::parse();

		return self::$config[$config];
	}
}
