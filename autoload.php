<?php

if(file_exists(__DIR__.'/vendor/autoload.php')){
	require_once __DIR__.'/vendor/autoload.php';
}

class PlatronSdkAutoloader {
	public static function autoload($className) {
		$parsedPath = explode('\\', $className);
		
		if(empty($parsedPath) || $parsedPath[0] != 'Platron' ){
			return;
		}
		unset($parsedPath[0]);
		unset($parsedPath[1]);
		array_unshift($parsedPath, 'src');

		include(implode('\\',$parsedPath).'.php');
	}
}

spl_autoload_register(array('PlatronSdkAutoloader', 'autoload'), true, true);