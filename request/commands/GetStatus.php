<?php

namespace platron_sdk\request\commands;

/**
 * Класс для получения статуса по транзакции
 */
class GetStatus extends BaseCommand {

	/** @var int Id транзакции */
	protected $pg_payment_id;
	
	/** @var string Order id транзакции у магазина */
	protected $pg_order_id;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'get_status.php';
	}

	/**
	 * Поиск происходил либо по номеру транзакции в platron, либо по order id магазина
	 * @param int $payment Id транзакции
	 * @param string $order Order id транзакции в магазине
	 * @return $this
	 */
	public function __construct($payment = null, $order = null) {
		if($payment){
			$this->pg_payment_id = $payment;
		}
		else {
			$this->pg_order_id = $order;
		}
		
		return $this;
	}

}
