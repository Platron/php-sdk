<?php

namespace platron_sdk\request\commands;

/**
 * Класс для получения статуса по транзакции
 */
class GetStatus extends Command implements iCommand{
	
	/** @var int Id транзакции */
	protected $payment;
	
	/**
	 * @param int $payment Id транзакции
	 * @return $this
	 */
	public function __construct($payment) {
		$this->payment = $payment;
		return $this;
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'get_status.php';
	}
}
