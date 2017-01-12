<?php

// DEBUG
ini_set("xdebug.var_display_max_depth" , 10);
ini_set("xdebug.var_display_max_children", 256);
ini_set("xdebug.var_display_max_data", 1024);

// Setup autoloader
require_once "../cfg/autoloader.php";

$config = parse_ini_file("../cfg/paths.ini");
$autoloader = new Autoloader($config["paths"], $config["extensions"]);

// Run router
$router = new Router();
