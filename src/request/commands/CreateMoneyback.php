<?php

namespace platron_sdk\request\commands;

/**
 * Команда для создания выплаты. Может быть связана с платежной транзакцией
 */
class CreateMoneyback extends BaseCommand {

	/** @var int Id договора */
	protected $pg_contract_id;

	/** @var string Название системы выплат */
	protected $pg_moneyback_system;

	/** @var float Сумма */
	protected $pg_amount;

	/** @var string Описание */
	protected $pg_description;

	/** @var int $transaction Id транзакции */
	protected $pg_payment_id;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'create_moneyback.php';
	}

	/**
	 * @param int $contract Id договора (можно получить из GetMoneybackList)
	 * @param string $moneybackSystem Название системы выплат
	 * @param float $amount Сумма выплаты
	 * @param string $description Описание выплаты
	 * @param array $additionalParams Дополнительные параметры, необходимые для системы выплат (можно получить из GetMoneybackList)
	 */
	public function __construct($contract, $moneybackSystem, $amount, $description, $additionalParams) {
		$this->pg_contract_id = $contract;
		$this->pg_moneyback_system = $moneybackSystem;
		$this->pg_amount = $amount;
		$this->pg_description = $description;
		foreach($additionalParams as $name => $param){
			$this->$name = $param;
		}
	}

	/**
	 * Привязать выплату к транзакции
	 * @param int $payment Id транзакции
	 */
	public function bindToTransaction($payment) {
		$this->pg_payment_id = $payment;
	}

}
