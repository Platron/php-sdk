<?php

namespace platron\request\commands;

/**
 * Команда для создания выплаты. Может быть связана с платежной транзакцией
 */
class CreateMoneyback extends Command implements iCommand {
	
	/** @var int Id договора */
	protected $contract;
	/** @var string Название системы выплат */
	protected $moneybackSystem;
	/** @var float Сумма */
	protected $amount;
	/** @var string Описание */
	protected $description;
	/** @var array Дополнительные параметры для манибек системы */
	protected $additionalParams;
	/** @var int $transaction Id транзакции */
	protected $payment;
	
	/**
	 * @param int $contract Id договора (можно получить из GetMoneybackList)
	 * @param string $moneybackSystem Название системы выплат
	 * @param float $amount Сумма выплаты
	 * @param string $description Описание выплаты
	 * @param array $additionalParams Дополнительные параметры, необходимые для системы выплат (можно получить из GetMoneybackList)
	 */
	public function __construct($contract, $moneybackSystem, $amount, $description, $additionalParams) {
		$this->contract = $contract;
		$this->moneybackSystem = $moneybackSystem;
		$this->amount = $amount;
		$this->description = $description;
		$this->additionalParams = $additionalParams;
	}
	
	/**
	 * Привязать выплату к транзакции
	 * @param int $payment Id транзакции
	 */
	public function bindToTransaction($payment){
		$this->payment = $payment;
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'create_moneyback.php';
	}

}
