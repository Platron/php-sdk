<?php

namespace platron_sdk\request\data_objects;

abstract class Data {
	public function getParameters() {
		$parameters = [];
		foreach(get_object_vars($this) as $name => $value){
			if($value){
				$parameters[$name] = $value;
			}
		}
		return $parameters;
	}
}
