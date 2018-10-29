<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для получения статуса выплаты
 */
class GetMoneybackStatusBulder extends RequestBuilder
{

	/** @var $moneyback */
	private $pg_moneyback_id;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'get_moneyback_status.php';
	}

	/**
	 * @param int $moneyback Id манибека
	 */
	public function __construct($moneyback)
	{
		$this->pg_moneyback_id = $moneyback;
	}

}
