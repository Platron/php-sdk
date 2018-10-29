<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для создания выплаты. Может быть связана с платежной транзакцией
 */
class CreateMoneybackBuilder extends RequestBuilder
{

	/** @var int Id договора */
	private $pg_contract_id;

	/** @var string Название системы выплат */
	private $pg_moneyback_system;

	/** @var float Сумма */
	private $pg_amount;

	/** @var string Описание */
	private $pg_description;

	/** @var int $transaction Id транзакции */
	private $pg_payment_id;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'create_moneyback.php';
	}

	/**
	 * @param int $contract Id договора (можно получить из GetMoneybackList)
	 * @param string $moneybackSystem Название системы выплат
	 * @param float $amount Сумма выплаты
	 * @param string $description Описание выплаты
	 * @param array $additionalParams Дополнительные параметры, необходимые для системы выплат (можно получить из GetMoneybackList)
	 */
	public function __construct($contract, $moneybackSystem, $amount, $description, $additionalParams)
	{
		$this->pg_contract_id = $contract;
		$this->pg_moneyback_system = $moneybackSystem;
		$this->pg_amount = $amount;
		$this->pg_description = $description;
		foreach ($additionalParams as $name => $param) {
			$this->$name = $param;
		}
	}

	/**
	 * Привязать выплату к транзакции
	 * @param int $payment Id транзакции
	 */
	public function bindToTransaction($payment)
	{
		$this->pg_payment_id = $payment;
	}

}
