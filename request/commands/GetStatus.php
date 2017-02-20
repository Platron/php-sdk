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
	 */
	public function __construct($payment) {
		$this->payment = $payment;
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'get_status.php';
	}
}
