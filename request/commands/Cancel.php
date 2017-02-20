<?php

namespace platron\request\commands;

/**
 * Команда для отмены транзакции, которая еще не была оплачена
 */
class Cancel extends Command implements iCommand {
	
	/** @var int $payment */
	protected $payment;
	
	/**
	 * @param int $payment
	 */
	public function __construct($payment) {
		$this->payment = $payment;
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'cancel.php';
	}

}
