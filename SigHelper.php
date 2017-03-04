<?php

namespace platron_sdk;

use SimpleXMLElement;

class SigHelper {
	
	/** @var string Секретное слово */
	protected $secretKey;
	
	/**
	 * Returns flat array of XML params
	 *
	 * @param (string|SimpleXMLElement) $xml
	 * @return array
	 */
	private function makeFlatParamsXML ( $xml, $parentName = '' )
	{
		if ( ! $xml instanceof SimpleXMLElement ) {
			$xml = new SimpleXMLElement($xml);
		}

		$params = array();
		$i = 0;
		foreach ( $xml->children() as $tag ) {
			
			$i++;
			if ( 'pg_sig' === $tag->getName() )
				continue;
				
			/**
			 * Имя делаем вида tag001subtag001
			 * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
			 */
			$name = $parentName . $tag->getName().sprintf('%03d', $i);

			if ( $tag->children()->count() > 0 ) {
				$params = array_merge($params, $this->makeFlatParamsXML($tag, $name));
				continue;
			}

			$params += array($name => (string)$tag);
		}

		return $params;
	}
	
	/**
	 * Return concated string to make hash
	 * 
	 * @param type $scriptName
	 * @param array $params
	 * @return type
	 */
	private function makeSigStr ( $scriptName, array $params ) {
		if(!empty($params['pg_sig'])){
			unset($params['pg_sig']);
		}
		
		ksort($params);

		array_unshift($params, $scriptName);
		array_push   ($params, $this->secretKey );

		return join(';', $params);
	}	
	
	/**
	 * Returns flat array
	 * 
	 * @param array $params
	 * @param string $parentName
	 * @return array
	 */
	private function makeFlatParamsArray ( $params, $parentName = '' )
	{
		$flatParams = array();
		$i = 0;
		foreach ( $params as $key => $val ) {
			
			$i++;
			if ( 'pg_sig' === $key )
				continue;
				
			/**
			 * Имя делаем вида tag001subtag001
			 * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
			 */
			$name = $parentName . $key . sprintf('%03d', $i);

			if (is_array($val) ) {
				$flatParams = array_merge($flatParams, $this->makeFlatParamsArray($val, $name));
				continue;
			}

			$flatParams += array($name => (string)$val);
		}

		return $flatParams;
	}

	/**
	 * @param type $secretKey
	 */
	public function __construct($secretKey) {
		$this->secretKey = $secretKey;
	}
	
	/**
	 * Get script name from URL
	 *
	 * @param string $url
	 * @return string
	 */
	public function getScriptNameFromUrl ( $url )
	{
		$path = parse_url($url, PHP_URL_PATH);
		$len  = strlen($path);
		if ( $len == 0  ||  '/' == $path{$len-1} ) {
			return "";
		}
		return basename($path);
	}
	
	/**
	 * Creates a signature
	 *
	 * @param string $scriptName String where will be request
	 * @param array $params  associative array of parameters for the signature
	 * @return string
	 */
	public function make ( $scriptName, $params )
	{
		$flatParams = $this->makeFlatParamsArray($params);
		return md5( $this->makeSigStr($scriptName, $flatParams) );
	}

	/**
	 * Verifies the signature
	 *
	 * @param string $signature
	 * @param array $params  associative array of parameters for the signature
	 * @return bool
	 */
	public function check ( $signature, $scriptName, $params )
	{
		return (string)$signature === $this->make($scriptName, $params );
	}

	/**
	 * Make the signature for XML
	 *
	 * @param string $scriptName String where will be request
	 * @param string|SimpleXMLElement $xml
	 * @return string
	 */
	public function makeXML ( $scriptName, $xml )
	{
		$flatParams = $this->makeFlatParamsXML($xml);
		return $this->make($scriptName, $flatParams, $this->secretKey);
	}
}