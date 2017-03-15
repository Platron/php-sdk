<?php

namespace Platron\PhpSdk\request\commands;

/**
 * Команда для отмены транзакции, которая еще не была оплачена
 */
class Cancel extends BaseCommand {

	/** @var int $payment */
	protected $pg_payment_id;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'cancel.php';
	}

	/**
	 * @param int $payment
	 */
	public function __construct($payment) {
		$this->pg_payment_id = $payment;
	}

}
