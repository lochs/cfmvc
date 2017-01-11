<?php

class Database
{
	private static $link = null;
	public static $error = null;

	private function __construct() {
	}

	private function connect() {
		$config = Config::getConfig("Database");

		$dsn = "mysql:host=" . $config['hostname'] . ";dbname=" . $config['dbname'];
		$opts = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		try {
			self::$link = new PDO($dsn, $config['username'], $config['password'], $opts);
		} catch(PDOException $e) {
			self::$error = $e->getMessage();

			return false;
		}

		return true;
	}

	public static function getConnection() {
		if(is_null(self::$link)) {
			if(!self::connect())
				return false;
		}

		return self::$link;
	}
}
