<?php

namespace Platron\PhpSdk\request\clients;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\request_builders\RequestBuilder;
use Platron\PhpSdk\SigHelper;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Psr\Log\LogLevel;

class PostClient implements iClient {

    /** @var string|null Описание ошибки */
	protected $errorDescription;
	/** @var mixed|null Код ошибки */
	protected $errorCode;
	
	/** @var int Номер магазина */
	protected $merchant;
	
	/** @var SigHelper Помощник создания подписи */
	protected $sigHelper;
	
	/** @var string */
	protected $secretKey;
	
    /** @var LoggerInterface */
    protected $logger;
    
    /** @var array */
    private $additionalCurlParameters = array();

	/**
	 * @inheritdoc
	 * @throws Exception
	 */
	public function __construct($merchant, $secretKey, LoggerInterface $logger = null){
		$this->merchant = $merchant;
		$this->sigHelper = new SigHelper($secretKey);
		$this->secretKey = $secretKey;
        $this->logger = $logger;
	}
	
	/**
	 * Отправить запрос
	 * @inheritdoc
	 * @return SimpleXMLElement
	 * @throws Exception
	 */
	public function request(RequestBuilder $requestBuilder){
		$parameters = $requestBuilder->getParameters();
		$url = $requestBuilder->getRequestUrl();
		
		$parameters['pg_merchant_id'] = $this->merchant;
		$parameters['pg_salt'] = rand(21,43433);
		
		$fileName = pathinfo($url);
		$parameters['pg_sig'] = $this->sigHelper->make($fileName['basename'], $parameters);
		
		$curl = curl_init();
		curl_setopt_array($curl, $this->additionalCurlParameters);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		
        if($this->logger){
            $this->logger->log(LogLevel::INFO, 'Request url '.$requestBuilder->getRequestUrl().' with params '.print_r($parameters, true));
            $this->logger->log(LogLevel::INFO, 'Response '.$response);
        }
        
		if(curl_errno($curl)){
			throw new Exception(curl_error($curl), curl_errno($curl));
		}
		
		curl_close($curl);
		
		if($this->hasError($response, $url )){
			throw new Exception($this->errorDescription, $this->errorCode);
		}
		
		return new SimpleXMLElement($response);
	}
	
	/**
	 * Проверить ответ на наличие ошибок
	 * @param string $response
	 * @param string $url
	 * @return boolean
	 */
	protected function hasError($response, $url) {
		try {
			$xml = new SimpleXMLElement($response);
		}
		catch (\Exception $e){
			$this->errorCode = $e->getCode();
			$this->errorDescription = $e->getMessage();
			return true;
		}
		
		$sigHelper = new SigHelper($this->secretKey);
		if(empty($xml->pg_sig) || !$sigHelper->checkXml($xml->pg_sig, $sigHelper->getScriptNameFromUrl($url), $xml)){
			$this->errorDescription = 'Not valid sig in response';
			return true;
		}
		
		if (!empty($xml->pg_error_code)) {
			$this->errorCode = (string) $xml->pg_error_code;
			$this->errorDescription = (string) $xml->pg_error_description;
			return true;
		}

		return false;
	}

	/**
	 * Добавляет дополнительные параметры к curl клиенту.
	 * @param array $parameters
	 */
	public function setAdditionalCurlParameters(array $parameters) {
		$this->additionalCurlParameters = $parameters;
	}

}
