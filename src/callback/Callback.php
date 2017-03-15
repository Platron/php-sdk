<?php

namespace Platron\PhpSdk\callback;

use Platron\PhpSdk\SigHelper;
use SimpleXMLElement;

class Callback {
	
	/** @var string Скрипт магазина, на который делается запрос */
	protected $urlScriptName;
	
	/** @var SigHelper Помощник для создания подписи */
	protected $sigHelper;
	
	/**
	 * Ответить в Platron
	 */
	protected function response($salt, $status, $description){
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><response/>');
		$xml->addChild('pg_salt', $salt); // в ответе необходимо указывать тот же pg_salt, что и в запросе
		$xml->addChild('pg_status', $status);
		$xml->addChild('pg_description', $description);
		$xml->addChild('pg_sig', $this->sigHelper->makeXml($this->urlScriptName, $xml));
		
		return $xml;
	}
	
	/**
	 * @param string $urlScriptName Название скрипта, из url, на который Platron делает запрос. Например, www.site.ru/request - будет request
	 * @param string $secretKey
	 */
	public function __construct($urlScriptName, $secretKey){
		$this->urlScriptName = $urlScriptName;
		$this->sigHelper = new SigHelper($secretKey);
	}
	
	/**
	 * Валидировать запрос от platron (внимательно проверяем, что ваша система не добавляет дополнительно параметров, которых не было в запросе от platron)
	 * @param array $params
	 * @return boolean
	 */
	public function validateSig($params){
		return $this->sigHelper->check($params['pg_sig'], $this->urlScriptName, $params);
	}
	
	/**
	 * Можно ли отказаться от платежа
	 * @param array $params
	 */
	public function canReject($params){
		return !empty($params['pg_can_reject']) && $params['pg_can_reject'];
	}
	
	/**
	 * Ответить ошибкой
	 * @param array $params
	 * @param string $error
	 * @return SimpleXMLElement
	 */
	public function responseError($params, $error){
		return $this->response(@$params['pg_salt'], 'error', $error);
	}
	
	/**
	 * В ответе попросить вернуть платеж
	 * @param array $params
	 * @param string $description
	 * return SimpleXMLElement
	 */
	public function responseRejected($params, $description){
		return $this->response(@$params['pg_salt'], 'rejected', $description);
	}
	
	/**
	 * Ответить, что успешно получил запрос
	 * @param array $params
	 * return SimpleXMLElement
	 */
	public function responseOk($params){
		return $this->response(@$params['pg_salt'], 'ok', 'ok');
	}
}
