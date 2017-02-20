<?php

namespace platron\request;

use platron\request\commands\iCommand;
use platron\SigHelper;
use SimpleXMLElement;

class Requester {
	
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
	
	public function request(iCommand $command){
		$commandParams = $command->getParameters();
		$commandParams['pg_merchant_id'] = $this->merchant;
		$commandParams['pg_salt'] = rand(21,43433);
		
		$fileName = pathinfo($command->getRequestUrl())['basename'];
		$commandParams['pg_sig'] = SigHelper::make($fileName, $commandParams, $this->secretKey);

		$response = new SimpleXMLElement(file_get_contents($command->getRequestUrl().'?'.http_build_query($commandParams)));
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
