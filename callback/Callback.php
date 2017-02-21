<?php

namespace platron_sdk\callback;

use platron_sdk\SigHelper;
use SimpleXMLElement;

class Callback {

	/** @var string Секреный ключ */
	protected $secretKey;
	
	/**
	 * Ответить в Platron
	 */
	protected function response($salt, $status, $description){
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><response/>');
		$xml->addChild('pg_salt', $salt); // в ответе необходимо указывать тот же pg_salt, что и в запросе
		$xml->addChild('pg_status', $status);
		$xml->addChild('pg_description', $description);
		$xml->addChild('pg_sig', SigHelper::makeXML(SigHelper::getOurScriptName(), $xml, $this->secretKey));
		
		return $xml;
	}
	
	/**
	 * @param string $secretKey
	 */
	public function __construct($secretKey){
		$this->secretKey = $secretKey;
	}
	
	/**
	 * Валидировать запрос от platron (внимательно проверяем, что ваша система не добавляет дополнительно параметров, которых не было в запросе от platron)
	 * @param array $params
	 * @return boolean
	 */
	public function validateSig($params){
		return SigHelper::check($params['pg_sig'], SigHelper::getOurScriptName(), $params, $this->secretKey);
	}
	
	/**
	 * Можно ли отказаться от платежа
	 * @param array $params
	 */
	public function canReject($params){
		return !empty($params['pg_can_reject']);
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
