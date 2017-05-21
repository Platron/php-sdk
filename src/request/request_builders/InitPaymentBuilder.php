<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\request\data_objects\AviaGds;
use Platron\PhpSdk\request\data_objects\BankCard;
use Platron\PhpSdk\Exception;

/**
 * Строитель для создании транзакции
 */
class InitPaymentBuilder extends RequestBuilder {

	/** @var float Сумма транзакции */
	protected $pg_amount;

	/** @var string Описание транзакции */
	protected $pg_description;

	/** @var BankCard Данные банковской карты */
	protected $bankCard;

	/** @var AviaGds Данные по GDS */
	protected $aviaGds;

	/** @var string Номер заказа в магазине */
	protected $pg_order_id;

	/** @var string Валюта транзакции */
	protected $pg_currency;

	/** @var int Время жизни счета транзакции */
	protected $pg_lifetime;

	/** @var boolean Отлиженный платеж */
	protected $pg_postpone;

	/** @var strind Язык транзакции */
	protected $pg_language;

	/** @var boolean Установлен ли демо режим */
	protected $pg_testing_mode;

	/** @var boolean Стартовать ли рекуррентный профиль */
	protected $pg_recurring_start;

	/** @var string Заранее выбранная платежная система */
	protected $pg_payment_system;

	/** @var string Check url */
	protected $pg_check_url;

	/** @var string Result url */
	protected $pg_result_url;

	/** @var string Refund url */
	protected $pg_refund_url;

	/** @var string Capture url */
	protected $pg_capture_url;

	/** @var string Request method */
	protected $pg_request_method;

	/** @var string Success url */
	protected $pg_success_url;

	/** @var string Success url method */
	protected $pg_success_url_method;

	/** @var string State url */
	protected $pg_state_url;

	/** @var string State url method */
	protected $pg_state_url_method;

	/** @var string Failure url */
	protected $pg_failure_url;

	/** @var string Failure url method */
	protected $pg_failure_url_method;

	/** @var string Site url */
	protected $pg_site_url;

	/** @var string IP клиента в формате long */
	protected $pg_user_ip;

	/** @var string Email клиента */
	protected $pg_user_contact_email;

	/** @var string Телефон клиента */
	protected $pg_user_phone;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl() {
		return self::PLATRON_URL . 'init_payment.php';
	}

	/**
	 * @inheritdoc
	 */
	public function getParameters() {
		$filledvars = array();
		foreach (get_object_vars($this) as $name => $value) {
			if ($value && !in_array($name, array('bankCard', 'aviaGds'))) {
				$filledvars[$name] = (string)$value;
			}
		}

		if (!empty($this->aviaGds)) {
			foreach ($this->aviaGds->getParameters() as $name => $value) {
				$filledvars[$name] = (string)$value;
			}
		}

		if (!empty($this->bankCard)) {
			foreach ($this->bankCard->getParameters() as $name => $value) {
				$filledvars[$name] = (string)$value;
			}
		}

		return $filledvars;
	}

	/**
	 * @param float $amount Сумма транзакции
	 * @param string $description Описание транзакции
	 */
	public function __construct($amount, $description) {
		$this->pg_amount = $amount;
		$this->pg_description = $description;
	}

	/**
	 * Уставновить банковскую карту
	 * Внимание! Возможно использование только при наличии у магазина сертификата PSI DSS и при согласовании с менеджером
	 * @param BankCard $bankCard
	 * @return $this
	 */
	public function addBankCard(BankCard $bankCard) {
		$this->bankCard = $bankCard;
		return $this;
	}

	/**
	 * Установить GDS данные. Используется после согласования с менеджером
	 * @param AviaGds $aviaGds
	 * @return $this
	 */
	public function addGds(AviaGds $aviaGds) {
		$this->aviaGds = $aviaGds;
		return $this;
	}

	/**
	 * Установить в тарнзакцию платежную систему
	 * @param string $paymentSystem
	 * @return $this
	 */
	public function addPaymentSystem($paymentSystem) {
		$this->pg_payment_system = $paymentSystem;
		return $this;
	}

	/**
	 * Добавить номер заказа магазина
	 * @param string $order
	 * @return $this
	 */
	public function addOrderId($order) {
		$this->pg_order_id = $order;
		return $this;
	}

	/**
	 * Добавить валюту транзакции
	 * @param string $currency
	 * @return $this
	 */
	public function addCurrency($currency) {
		$this->pg_currency = $currency;
		return $this;
	}

	/**
	 * Установить время жизни транзакции
	 * @param int $lifetime
	 * @return $this
	 */
	public function addLifetime($lifetime) {
		$this->pg_lifetime = $lifetime;
		return $this;
	}

	/**
	 * Установить транзакцию как отложенную
	 * @return $this
	 */
	public function addPostpone() {
		$this->pg_postpone = 1;
		return $this;
	}

	/**
	 * Установить язык транзакции
	 * @param type $language
	 * @return $this
	 */
	public function addLanguageEn() {
		$this->pg_language = 'en';
		return $this;
	}

	/**
	 * Установить демо режим транзакции
	 * @return $this
	 */
	public function addTestingMode() {
		$this->pg_testing_mode = 1;
		return $this;
	}

	/**
	 * Установить старт рекуррентной транзакции. Необходимо согласование с магазином
	 * @return $this
	 */
	public function addRecurringStart() {
		$this->pg_recurring_start = 1;
		return $this;
	}

	/**
	 * Добавить check url
	 * @param string $url
	 * @return $this
	 */
	public function addCheckUrl($url) {
		$this->pg_check_url = $url;
		return $this;
	}

	/**
	 * Добавить result url
	 * @param string $url
	 * @return $this
	 */
	public function addResultUrl($url) {
		$this->pg_result_url = $url;
		return $this;
	}

	/**
	 * Добавить refund url
	 * @param string $url
	 * @return $this
	 */
	public function addRefundUrl($url) {
		$this->pg_refund_url = $url;
		return $this;
	}

	/**
	 * Добавить capture url
	 * @param string $url
	 * @return $this
	 */
	public function addCaptureUrl($url) {
		$this->pg_capture_url = $url;
		return $this;
	}

	/**
	 * Добавить request метод
	 * @param string $method
	 * @return $this
	 */
	public function addRequestMethod($method) {
		$this->pg_request_method = $method;
		return $this;
	}

	/**
	 * Добавить success url
	 * @param string $url
	 * @return $this
	 */
	public function addSuccessUrl($url) {
		$this->pg_success_url = $url;
		return $this;
	}

	/**
	 * Добавить success url method
	 * @param string $method
	 * @return $this
	 */
	public function addSuccessUrlMethod($method) {
		$this->pg_success_url_method = $method;
		return $this;
	}

	/**
	 * Добавить state url
	 * @param string $url
	 * @return $this
	 */
	public function addStateUrl($url) {
		$this->pg_state_url = $url;
		return $this;
	}

	/**
	 * Добавить state url method
	 * @param string $method
	 * @return $this
	 */
	public function addStateUrlMethod($method) {
		$this->pg_state_url_method = $method;
		return $this;
	}

	/**
	 * Добавить failure url
	 * @param string $url
	 * @return $this
	 */
	public function addFailureUrl($url) {
		$this->pg_failure_url = $url;
		return $this;
	}

	/**
	 * Добавить failure url method
	 * @param string $method
	 * @return $this
	 */
	public function addFailureUrlMethod($method) {
		$this->pg_failure_url_method = $method;
		return $this;
	}

	/**
	 * Добавить site url
	 * @param string $url
	 * @return $this
	 */
	public function addSiteUrl($url) {
		$this->pg_site_url = $url;
		return $this;
	}

	/**
	 * Добавить номер телефона покупателя
	 * @param int $phone
	 * @return $this
	 */
	public function addUserPhone($phone) {
		$this->pg_user_phone = $phone;
		return $this;
	}

	/**
	 * Добавить email покупателя
	 * @param string $email
	 * @return $this
	 */
	public function addUserEmail($email) {
		$this->pg_user_contact_email = $email;
		return $this;
	}

	/**
	 * Добавить ip покупателя в формате long
	 * @param string $ip
	 * @return $this
	 */
	public function addUserIp($ip) {
		$this->pg_user_ip = $ip;
		return $this;
	}

	/**
	 * Установить произвольные поля магазина
	 * @param type $parameters
	 * @return $this
	 */
	public function addMerchantParams($parameters) {
		foreach ($parameters as $name => $value) {
			if (substr($name, 0, 3) == 'pg_') {
				throw new Exception('Только параметры без pg_');
			}
			$this->$name = $value;
			return $this;
		}
	}

	/**
	 * Установить дополнительные для ПС параметры (например, для альфаклик идентификатор в интернет банке)
	 * @param array $parameters
	 * @return $this
	 */
	public function addPsAdditionalParameters($parameters) {
		foreach ($parameters as $name => $value) {
			if(substr($name, 0, 3) !== 'pg_'){
				throw new Exception('Только параметры с pg_');
			}
			$this->$name = $value;
		}
		return $this;
	}

}
