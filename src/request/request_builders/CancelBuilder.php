<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для отмены транзакции, которая еще не была оплачена
 */
class CancelBuilder extends RequestBuilder
{

	/** @var int $payment */
	private $pg_payment_id;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'cancel.php';
	}

	/**
	 * @param int $payment
	 */
	public function __construct($payment)
	{
		$this->pg_payment_id = $payment;
	}

}
