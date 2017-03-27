<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для создания заявки на возврат. См. поддерживающие ПС в справочнике в документации
 */
class CreateRefundRequestBuilder extends RequestBuilder {

	/** @var int Id Платежа */
	protected $pg_payment_id;

	/** @var float Сумма заявки на возврат */
	protected $pg_refund_amount;

	/** @var string Причина возврата */
	protected $pg_comment;
	
	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'create_refund_request.php';
	}

	/**
	 * @param int $payment Id транзакции
	 * @param float $amount Сумма заявки на возврат
	 * @param string $comment Причина возврата
	 */
	public function __construct($payment, $amount, $comment) {
		$this->pg_payment_id = $payment;
		$this->pg_refund_amount = $amount;
		$this->pg_comment = $comment;
	}

}
