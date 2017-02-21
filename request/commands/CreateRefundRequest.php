<?php

namespace platron_sdk\request\commands;

/**
 * Команда для создания заявки на возврат. См. поддерживающие ПС в справочнике в документации
 */
class CreateRefundRequest extends Command implements iCommand {
	
	/** @var int Id Платежа*/
	protected $payment;
	/** @var float Сумма заявки на возврат */
	protected $amount;
	
	/**
	 * @param int $payment Id транзакции
	 * @param float $amount Сумма заявки на возврат
	 * @return $this
	 */
	public function __construct($payment, $amount) {
		$this->payment = $payment;
		$this->amount = $amount;
		return $this;
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'create_refund_request.php';
	}

}
