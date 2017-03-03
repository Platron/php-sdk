<?php

namespace platron_sdk\request\clients;

use platron_sdk\Exception;
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
	
	/**
	 * Отправить запрос
	 * @param type $url
	 * @param type $parameters
	 * @return SimpleXMLElement
	 * @throws Exception
	 */
	public function request($url, $parameters){
		$parameters['pg_merchant_id'] = $this->merchant;
		$parameters['pg_salt'] = rand(21,43433);
		
		$fileName = pathinfo($url);
		$parameters['pg_sig'] = SigHelper::make($fileName['basename'], $parameters, $this->secretKey);

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = new SimpleXMLElement(curl_exec($curl));
		curl_close($curl);
		
		if(curl_errno($curl)){
			throw new Exception(curl_error($curl), curl_errno($curl));
		}
		
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
	protected function hasError(SimpleXMLElement $xml) {
		if (!empty($xml->pg_error_code)) {
			$this->errorCode = (string) $xml->pg_error_code;
			$this->errorDescription = (string) $xml->pg_error_description;
			return true;
		}

		return false;
	}

}
