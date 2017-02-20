<?php

namespace platron\request\commands;

use platron\request\data_objects\AviaGds;
use platron\request\data_objects\BankCard;
use platron\request\Exception;

/**
 * Команда для создании транзакции
 */
class InitPayment extends Command implements iCommand{
	
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
	/** @var string State url method*/
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
	 * @param float $amount Сумма транзакции
	 * @param string $description Описание транзакции
	 */
	public function __construct($amount, $description) {
		$this->pg_amount = $amount;
		$this->pg_description = $description;
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'init_payment.php';
	}
	
	/**
	 * Уставновить банковскую карту
	 * @param BankCard $bankCard
	 */
	public function addBankCard(BankCard $bankCard){
		$this->bankCard = $bankCard;
	}
	
	/**
	 * Установить GDS данные
	 * @param AviaGds $aviaGds
	 */
	public function addGds(AviaGds $aviaGds){
		$this->aviaGds = $aviaGds;
	}
	
	/**
	 * Установить в тарнзакцию платежную систему
	 * @param string $paymentSystem
	 */
	public function addPaymentSystem($paymentSystem){
		$this->pg_payment_system = $paymentSystem;
	}
	
	/**
	 * Добавить номер заказа магазина
	 * @param string $order
	 */
	public function addOrderId($order){
		$this->pg_order_id = $order;
	}

	/**
	 * Добавить валюту транзакции
	 * @param string $currency
	 */
	public function addCurrency($currency){
		$this->pg_currency = $currency;
	}
	
	/**
	 * Установить время жизни транзакции
	 * @param type $lifetime
	 */
	public function addLifetime($lifetime){
		$this->pg_lifetime = $lifetime;
	}
	
	/**
	 * Установить транзакцию как отложенную
	 */
	public function addPostpone(){
		$this->pg_postpone = 1;
	}
	
	/**
	 * Установить язык транзакции
	 * @param type $language
	 */
	public function addLanguage($language){
		$this->pg_language = $language;
	}
	
	/**
	 * Установить демо режим транзакции
	 */
	public function addTestingMode(){
		$this->pg_testing_mode = 1;
	}
	
	/**
	 * Установить старт рекуррентной транзакции
	 */
	public function addRecurringStart(){
		$this->pg_recurring_start = 1;
	}
	
	/**
	 * Добавить check url
	 * @param string $url
	 */
	public function addCheckUrl($url){
		$this->pg_check_url = $url;
	}
	
	/**
	 * Добавить result url
	 * @param string $url
	 */
	public function addResultUrl($url){
		$this->pg_result_url = $url;
	}
	
	/**
	 * Добавить refund url
	 * @param string $url
	 */
	public function addRefundUrl($url){
		$this->pg_refund_url = $url;
	}
	
	/**
	 * Добавить capture url
	 * @param string $url
	 */
	public function addCaptureUrl($url){
		$this->pg_capture_url = $url;
	}
	
	/**
	 * Добавить request метод
	 * @param string $method
	 */
	public function addRequestMethod($method){
		$this->pg_request_method = $method;
	}
	
	/**
	 * Добавить success url
	 * @param string $url
	 */
	public function addSuccessUrl($url){
		$this->pg_success_url = $url;
	}
	
	/**
	 * Добавить success url method
	 * @param string $method
	 */
	public function addSuccessUrlMethod($method){
		$this->pg_success_url_method = $method;
	}
	
	/**
	 * Добавить state url
	 * @param string $url
	 */
	public function addStateUrl($url){
		$this->pg_state_url = $url;
	}
	
	/**
	 * Добавить state url method
	 * @param string $method
	 */
	public function addStateUrlMethod($method){
		$this->pg_state_url_method = $method;
	}
	
	/**
	 * Добавить failure url
	 * @param string $url
	 */
	public function addFailureUrl($url){
		$this->pg_failure_url = $url;
	}
	
	/**
	 * Добавить failure url method
	 * @param string $method
	 */
	public function addFailureUrlMethod($method){
		$this->pg_failure_url_method = $method;
	}
	
	/**
	 * Добавить site url
	 * @param string $url
	 */
	public function addSiteUrl($url){
		$this->pg_site_url = $url;
	}
	
	/**
	 * Добавить номер телефона покупателя
	 * @param int $phone
	 */
	public function addUserPhone($phone){
		$this->pg_user_phone = $phone;
	}
	
	/**
	 * Добавить email покупателя
	 * @param string $email
	 */
	public function addUserEmail($email){
		$this->pg_user_contact_email = $email;
	}
	
	/**
	 * Добавить ip покупателя в формате long
	 * @param string $ip
	 */
	public function addUserIp($ip){
		$this->pg_user_ip = $ip;
	}
	
	/**
	 * Установить произвольные поля магазина
	 * @param type $parameters
	 */
	public function addMerchantParams($parameters){
		foreach($parameters as $name => $value){
			if(substr($name, 0, 3) == 'pg_'){
				throw new Exception('Только параметры без pg_');
			}
			$this->$name = $value;
		}
	}
	
	/**
	 * Установить дополнительные для ПС параметры (например, для альфаклик идентификатор в интернет банке)
	 * @param array $parameters
	 */
	public function addPsAdditionalParameters($parameters){
		foreach($parameters as $name => $value){
			$this->$name = $value;
		}
	}
	
	public function getParameters() {
		$filledvars = [];
		foreach(get_object_vars($this) as $name => $value){
			if($value && !in_array($name, ['bankCard', 'aviaGds'])){
				$filledvars[$name] = $value;
			}
		}
		
		if(!empty($this->aviaGds)){
			foreach($this->aviaGds->getParameters() as $name => $value){
				$filledvars[$name] = $value;
			}
		}
		
		if(!empty($this->bankCard)){
			foreach($this->bankCard->getParameters() as $name => $value){
				$filledvars[$name] = $value;
			}
		}
		
		return $filledvars;
	}
}
