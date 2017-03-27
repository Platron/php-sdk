<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для получения манибек систем, номеров договора и параметров манибек систем для последующего запроса создания выплаты CreateMoneyback
 */
class MoneybackSystemListBuilder extends RequestBuilder {

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl() {
		return self::PLATRON_URL . 'moneyback_system_list.php';
	}

}
