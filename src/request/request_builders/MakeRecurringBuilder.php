<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\Exception;

/**
 * Строитель для создании транзакции по рекуррентному платежу. Рекуррентные платежи нужно согласовать с менеджером
 */
class MakeRecurringBuilder extends RequestBuilder
{

	/** @var int Id рекурретного профиля */
	private $pg_recurring_profile;

	/** @var string Описание платежа */
	private $pg_description;

	/** @var string Номер заказа магазина */
	private $pg_order_id;

	/** @var float Сумма */
	private $pg_amount;

	/** @var string Result Url */
	private $pg_result_url;

	/** @var string Refund Url */
	private $pg_refund_url;

	/** @var string Метод запросов */
	private $pg_request_method;

	/** @var string Кодировка запроса */
	private $pg_encoding;

	/** @var string IP адрес пользователя */
	private $pg_user_ip;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'make_recurring_payment.php';
	}

	/**
	 * @param int $recurringProfile Id рекуррентного платежа
	 * @param string $description Опсиание платежа
	 */
	public function __construct($recurringProfile, $description)
	{
		$this->pg_recurring_profile = $recurringProfile;
		$this->pg_description = $description;
	}

	/**
	 * Добавить номер заказа магазина к запросу
	 * @param int $order
	 * @return $this
	 */
	public function addOrderId($order)
	{
		$this->pg_order_id = $order;
		return $this;
	}

	/**
	 * Установить сумму. По умолчанию - равно сумме первого платежа
	 * @param float $amount
	 * @return $this
	 */
	public function addAmount($amount)
	{
		$this->pg_amount = $amount;
		return $this;
	}

	/**
	 * Установить result url в транзакции
	 * @param string $resultUrl
	 * @return $this
	 */
	public function addResultUrl($resultUrl)
	{
		$this->pg_result_url = $resultUrl;
		return $this;
	}

	/**
	 * Установить refund url в транзакцию
	 * @param string $refundUrl
	 * @return $this
	 */
	public function addRefundUrl($refundUrl)
	{
		$this->pg_refund_url = $refundUrl;
		return $this;
	}

	/**
	 * Установить метод для запроса в магазин
	 * @param string $reqestMethod
	 * @return $this
	 */
	public function addRequestMethod($reqestMethod)
	{
		$this->pg_request_method = $reqestMethod;
		return $this;
	}

	/**
	 * Установить кодировку транзакции
	 * @param string $encoding
	 * @return $this
	 */
	public function addEncoding($encoding)
	{
		$this->pg_encoding = $encoding;
		return $this;
	}

	/**
	 * @param array $params Список дополнительных параметров магазина
	 * @return $this
	 * @throws Exception
	 */
	public function addMerchantParams($params)
	{
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
	public function addUserIp($userIp)
	{
		$this->pg_user_ip = $userIp;
		return $this;
	}

}
