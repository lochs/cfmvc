<?php

// Setup autoloader
require_once "../cfg/Autoloader.php";

$config = parse_ini_file("../cfg/Paths.ini");
$autoloader = new Autoloader($config["paths"], $config["extensions"]);

// Run router
$router = new Router();
