<?php

namespace platron_sdk\request\commands;

/**
 * Команда для получения статуса выплаты
 */
class GetMoneybackStatus extends BaseCommand {

	/** @var $moneyback */
	protected $moneyback;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'get_moneyback_status.php';
	}

	/**
	 * @param int $moneyback Id манибека
	 * @return $this
	 */
	public function __construct($moneyback) {
		$this->moneyback = $moneyback;
		return $this;
	}

}
