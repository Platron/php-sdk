<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\Exception;

/**
 * Строитель для создании транзакции по рекуррентному платежу. Рекуррентные платежи нужно согласовать с менеджером
 */
class MakeRecurringBuilder extends RequestBuilder {

	/** @var int Id рекурретного профиля */
	protected $pg_recurring_profile;

	/** @var string Описание платежа */
	protected $pg_description;

	/** @var string Номер заказа магазина */
	protected $pg_order_id;

	/** @var float Сумма */
	protected $pg_amount;

	/** @var string Result Url */
	protected $pg_result_url;

	/** @var string Refund Url */
	protected $pg_refund_url;

	/** @var string Метод запросов */
	protected $pg_request_method;

	/** @var string Кодировка запроса */
	protected $pg_encoding;

	/** @var string IP адрес пользователя */
	protected $pg_user_ip;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl() {
		return self::PLATRON_URL . 'make_recurring_payment.php';
	}

	/**
	 * @param int $recurringProfile Id рекуррентного платежа
	 * @param string $description Опсиание платежа
	 */
	public function __construct($recurringProfile, $description) {
		$this->pg_recurring_profile = $recurringProfile;
		$this->pg_description = $description;
	}

	/**
	 * Добавить номер заказа магазина к запросу
	 * @param int $order
	 * @return $this
	 */
	public function addOrderId($order) {
		$this->pg_order_id = $order;
		return $this;
	}

	/**
	 * Установить сумму. По умолчанию - равно сумме первого платежа
	 * @param float $amount
	 * @return $this
	 */
	public function addAmount($amount) {
		$this->pg_amount = $amount;
		return $this;
	}

	/**
	 * Установить result url в транзакции
	 * @param string $resultUrl
	 * @return $this
	 */
	public function addResultUrl($resultUrl) {
		$this->pg_result_url = $resultUrl;
		return $this;
	}

	/**
	 * Установить refund url в транзакцию
	 * @param string $refundUrl
	 * @return $this
	 */
	public function addRefundUrl($refundUrl) {
		$this->pg_refund_url = $refundUrl;
		return $this;
	}

	/**
	 * Установить метод для запроса в магазин
	 * @param string $reqestMethod
	 * @return $this
	 */
	public function addRequestMethod($reqestMethod) {
		$this->pg_request_method = $reqestMethod;
		return $this;
	}

	/**
	 * Установить кодировку транзакции
	 * @param string $encoding
	 * @return $this
	 */
	public function addEncoding($encoding) {
		$this->pg_encoding = $encoding;
		return $this;
	}

	/**
	 * @param array $params Список дополнительных параметров магазина
	 * @return $this
	 * @throws Exception
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

	/**
	 * @param string $userIp
	 * @return $this
	 */
	public function addUserIp($userIp) {
		$this->pg_user_ip = $userIp;
		return $this;
	}

}
