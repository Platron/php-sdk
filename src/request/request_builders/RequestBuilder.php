<?php

namespace Platron\PhpSdk\request\request_builders;

abstract class RequestBuilder {

	const PLATRON_URL = 'https://www.platron.ru/';

	/**
	 * Получить url ждя запроса
	 * @return string
	 */
	abstract public function getRequestUrl();

	/**
	 * Получить параметры, сгенерированные командой
	 * @return array
	 */
	public function getParameters() {
		$filledvars = array();
		foreach (get_object_vars($this) as $name => $value) {
			if (!is_null($value)){
				$filledvars[$name] = (string)$value;
			}
		}

		return $filledvars;
	}
}
