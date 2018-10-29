<?php

namespace Platron\PhpSdk\request\data_objects;

abstract class BaseData
{

	/**
	 * Получить данные
	 * @return array
	 */
	public function getParameters()
	{
		$parameters = array();
		foreach (get_object_vars($this) as $name => $value) {
			if (!is_null($value)) {
				$parameters[$name] = $value;
			}
		}
		return $parameters;
	}
}
