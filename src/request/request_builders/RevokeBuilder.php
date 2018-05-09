<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для полного / частичного возврата оплаченной транзакции
 */
class RevokeBuilder extends RequestBuilder {

	/** @var int Id платежа */
	protected $pg_payment_id;

	/** @var float Сумма */
	protected $pg_refund_amount;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl() {
		return self::PLATRON_URL . 'revoke.php';
	}

	/**
	 * @param int $payment Id платежа
	 */
	public function __construct($payment) {
		$this->pg_payment_id = $payment;
	}

	/**
	 * Установка суммы возврата. По умолчанию возвращается вся сумма
	 * @param float $amount
	 */
	public function setAmount($amount) {
		$this->pg_refund_amount = $amount;
	}

}
