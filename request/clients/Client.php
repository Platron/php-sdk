<?php

namespace platron_sdk\request\clients;

use platron_sdk\SigHelper;
use SimpleXMLElement;

class Client implements iClient {
	
	/** @var Описание ошибки */
	protected $errorDescription;
	/** @var Код ошибки */
	protected $errorCode;
	
	/** @var int Номер магазина */
	protected $merchant;
	/** @var string Секреный ключ */
	protected $secretKey;
	
	/**
	 * @param int $merchant
	 * @param string $secretKey
	 * @throws Exception
	 */
	public function __construct($merchant, $secretKey){
		$this->merchant = $merchant;
		$this->secretKey = $secretKey;
	}
	
	public function request($url, $parameters){
		$parameters['pg_merchant_id'] = $this->merchant;
		$parameters['pg_salt'] = rand(21,43433);
		
		$fileName = pathinfo($url)['basename'];
		$parameters['pg_sig'] = SigHelper::make($fileName, $parameters, $this->secretKey);

		$response = new SimpleXMLElement(file_get_contents($url.'?'.http_build_query($parameters)));
		if($this->hasError($response)){
			throw new Exception($this->errorDescription, $this->errorCode);
		}
		
		return $response;
	}
	
	/**
	 * Проверить ответ на наличие ошибок
	 * @param SimpleXMLElement $xml
	 * @return boolean
	 */
	protected function hasError(SimpleXMLElement $xml){
		if(!empty($xml->pg_error_code)){
			$this->errorCode = (string)$xml->pg_error_code;
			$this->errorDescription = (string)$xml->pg_error_description;
			return true;
		}
		
		return false;
	}
}
