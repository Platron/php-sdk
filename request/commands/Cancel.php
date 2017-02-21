<?php

namespace platron_sdk\request\commands;

/**
 * Команда для отмены транзакции, которая еще не была оплачена
 */
class Cancel extends BaseCommand {
	
	/** @var int $payment */
	protected $payment;
	
	/**
	 * @param int $payment
	 * @return $this
	 */
	public function __construct($payment) {
		$this->payment = $payment;
		return $this;
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'cancel.php';
	}

}
