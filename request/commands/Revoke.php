<?php

namespace platron_sdk\request\commands;

/**
 * Команда для полного / частичного возврата оплаченной транзакции
 */
class Revoke extends Command implements iCommand{
	
	/** @var int Id платежа */
	protected $pg_payment_id;
	/** @var float Сумма */
	protected $pg_refund_amount;

	/**
	 * @param int $payment Id платежа
	 */
	public function __construct($payment) {
		$this->pg_payment_id = $payment;
	}
	
	/**
	 * Установка суммы возврата. По умолчанию возвращается вся сумма
	 * @param type $amount
	 */
	public function setAmount($amount){
		$this->pg_refund_amount = $amount;
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'revoke.php';
	}

}