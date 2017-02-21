<?php

namespace platron_sdk\request\commands;

use platron_sdk\request\clients\iClient;

abstract class BaseCommand {

	const PLATRON_URL = 'https://www.platron.ru/';

	/** @var array */
	protected $errors = [];

	/**
	 * Получить url ждя запроса
	 * @return string
	 */
	abstract protected function getRequestUrl();

	/**
	 * Получить параметры, сгенерированные командой
	 * @return array
	 */
	protected function getParameters() {
		$filledvars = [];
		foreach (get_object_vars($this) as $name => $value) {
			if ($value) {
				$filledvars[$name] = $value;
			}
		}

		return $filledvars;
	}

	public function execute(iClient $client) {
		return $client->request($this->getRequestUrl(), $this->getParameters());
	}

}
