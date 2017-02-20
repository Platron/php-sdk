<?php

namespace platron\request\commands;

/**
 * Команда для получения статуса выплаты
 */
class GetMoneybackStatus extends Command implements iCommand {
	
	/** @var $moneyback */
	protected $moneyback;
	
	/**
	 * @param int $moneyback Id манибека
	 */	
	public function __construct($moneyback){
		$this->moneyback = $moneyback;
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'get_moneyback_status.php';
	}

}
