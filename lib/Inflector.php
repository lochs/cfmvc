<?php

class Inflector {
	public static function singularize($string, $uppercase = false) {
		$string = rtrim($string, "s");
		if($uppercase)
			$string = ucwords($string);

		return $string;
	}
}
