<?php

namespace platron_sdk\request\commands;

use platron_sdk\request\Command;
use platron_sdk\request\iCommand;

/**
 * 
 */
class PsList extends Command implements iCommand{
	/** @var float Сумма */
	protected $pg_amount;
	/** @var string Валюта */
	protected $pg_currency;
	/** @var bool Тестовый режим */
	protected $pg_testing_mode;
	
	/**
	 * @param float $amount Сумма для расчета стоимости по каждой ПС
	 */
	public function __construct($amount) {
		$this->pg_amount = $amount;
	}
	
	/**
	 * Установить в запрос валюту. По умолчанию - рубли
	 * @param string $currency
	 */
	public function addCurrency($currency) {
		$this->pg_currency = $currency;
	}
	
	/**
	 * Установить тестовый режим в запрос
	 * @param bool $testingMode
	 */
	public function addTestingMode($testingMode) {
		$this->pg_testing_mode = $testingMode;
	}
	
	public function getParameters() {
		
	}

}
