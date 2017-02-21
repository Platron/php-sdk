<?php

namespace platron_sdk\request\commands;

/**
 * Класс для получения статуса по транзакции
 */
class GetStatus extends BaseCommand {

	/** @var int Id транзакции */
	protected $payment;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'get_status.php';
	}

	/**
	 * @param int $payment Id транзакции
	 * @return $this
	 */
	public function __construct($payment) {
		$this->payment = $payment;
		return $this;
	}

}
