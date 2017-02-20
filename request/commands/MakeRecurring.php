<?php

namespace platron_sdk\request\commands;

class MakeRecurring extends Command implements iCommand{
	
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
	 * @param int $recurringProfile Id рекуррентного платежа
	 * @param string $description Опсиание платежа
	 */
	public function __construct($recurringProfile, $description) {
		$this->recurringProfile = $recurringProfile;
		$this->description = $description;
	}
	
	public function getParameters() {
		
	}
	
	/**
	 * Добавить номер заказа магазина к запросу
	 * @param int $order
	 */
	public function addOrderId($order){
		$this->order = $order;
	}
	
	/**
	 * Установить сумму. По умолчанию - равно сумме первого платежа
	 * @param float $amount
	 */
	public function addAmount($amount){
		$this->amount = $amount;
	}
	
	/**
	 * Установить result url в транзакции
	 * @param string $resultUrl
	 */
	public function addResultUrl($resultUrl){
		$this->resultUrl = $resultUrl;
	}
	
	/**
	 * Установить refund url в транзакцию
	 * @param type $refundUrl
	 */
	public function addRefundUrl($refundUrl){
		$this->refundUrl = $refundUrl;
	}
	
	/**
	 * Установить метод для запроса в магазин
	 * @param string $reqestMethod
	 */
	public function addRequestMethod($reqestMethod){
		$this->requestMethod = $reqestMethod;
	}
	
	/**
	 * Установить кодировку транзакции
	 * @param string $encoding
	 */
	public function addEncoding($encoding){
		$this->encoding = $encoding;
	}
	
	/**
	 * @param array $params Список дополнительных параметров магазина
	 */
	public function addMerchantParams($params){
		foreach($params as $name => $value){
			if(substr($name, 0, 3) == 'pg_'){
				throw new Exception('Только параметры без pg_');
			}
			$this->$name = $value;
		}
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'make_recurring.php';
	}

}
