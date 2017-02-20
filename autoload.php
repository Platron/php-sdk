<?php


class PlatronSdkAutoloader {
	public static function autoload($className) {
		$parsedPath = explode('\\', $className);
		unset($parsedPath[0]);
		
		include(implode('\\',$parsedPath).'.php');
	}
}

spl_autoload_register(['PlatronSdkAutoloader', 'autoload'], true, true);