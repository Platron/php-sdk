<?php

namespace platron_sdk\request\commands;

/**
 * Команда для получения списка доступных платежных систем и расчета итоговой стоимости
 */
class PsList extends BaseCommand {
	/** @var float Сумма */
	protected $pg_amount;
	/** @var string Валюта */
	protected $pg_currency;
	/** @var bool Тестовый режим */
	protected $pg_testing_mode;
	
	/**
	 * @param float $amount Сумма для расчета стоимости по каждой ПС
	 * @return $this
	 */
	public function __construct($amount) {
		$this->pg_amount = $amount;
		return $this;
	}
	
	/**
	 * Установить в запрос валюту. По умолчанию - рубли
	 * @param string $currency
	 * @return $this
	 */
	public function addCurrency($currency) {
		$this->pg_currency = $currency;
		return $this;
	}
	
	/**
	 * Установить тестовый режим в запрос
	 * @param bool $testingMode
	 * @return $this
	 */
	public function addTestingMode($testingMode) {
		$this->pg_testing_mode = $testingMode;
		return $this;
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'ps_list.php';
	}

}
