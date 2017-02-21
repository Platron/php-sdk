<?php

namespace platron_sdk\request\commands;

use platron_sdk\Exception;

class MakeRecurring extends BaseCommand {

	/** @var int Id рекурретного профиля */
	protected $recurringProfile;

	/** @var string Описание платежа */
	protected $description;

	/** @var string Номер заказа магазина */
	protected $order;

	/** @var float Сумма */
	protected $amount;

	/** @var string Result Url */
	protected $resultUrl;

	/** @var string Refund Url */
	protected $refundUrl;

	/** @var string Метод запросов */
	protected $requestMethod;

	/** @var string Кодировка запроса */
	protected $encoding;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'make_recurring.php';
	}

	/**
	 * @param int $recurringProfile Id рекуррентного платежа
	 * @param string $description Опсиание платежа
	 * @return $this
	 */
	public function __construct($recurringProfile, $description) {
		$this->recurringProfile = $recurringProfile;
		$this->description = $description;
		return $this;
	}

	/**
	 * Добавить номер заказа магазина к запросу
	 * @param int $order
	 * @return $this
	 */
	public function addOrderId($order) {
		$this->order = $order;
		return $this;
	}

	/**
	 * Установить сумму. По умолчанию - равно сумме первого платежа
	 * @param float $amount
	 * @return $this
	 */
	public function addAmount($amount) {
		$this->amount = $amount;
		return $this;
	}

	/**
	 * Установить result url в транзакции
	 * @param string $resultUrl
	 * @return $this
	 */
	public function addResultUrl($resultUrl) {
		$this->resultUrl = $resultUrl;
		return $this;
	}

	/**
	 * Установить refund url в транзакцию
	 * @param type $refundUrl
	 * @return $this
	 */
	public function addRefundUrl($refundUrl) {
		$this->refundUrl = $refundUrl;
		return $this;
	}

	/**
	 * Установить метод для запроса в магазин
	 * @param string $reqestMethod
	 * @return $this
	 */
	public function addRequestMethod($reqestMethod) {
		$this->requestMethod = $reqestMethod;
		return $this;
	}

	/**
	 * Установить кодировку транзакции
	 * @param string $encoding
	 * @return $this
	 */
	public function addEncoding($encoding) {
		$this->encoding = $encoding;
		return $this;
	}

	/**
	 * @param array $params Список дополнительных параметров магазина
	 * @return $this
	 */
	public function addMerchantParams($params) {
		foreach ($params as $name => $value) {
			if (substr($name, 0, 3) == 'pg_') {
				throw new Exception('Только параметры без pg_');
			}
			$this->$name = $value;
		}
		return $this;
	}

}
