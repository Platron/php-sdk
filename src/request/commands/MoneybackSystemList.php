<?php

namespace platron_sdk\request\commands;

/**
 * Команда для получения манибек систем, номеров договора и параметров манибек систем для последующего запроса создания выплаты CreateMoneyback
 */
class MoneybackSystemList extends BaseCommand {

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'moneyback_system_list.php';
	}

}
