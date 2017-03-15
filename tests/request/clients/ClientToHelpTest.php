<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\clients\iClient;
use stdClass;

class ClientToHelpTest implements iClient{
	
	public function __construct($merchant, $secretKey) {}

	/**
	 * @param string $url
	 * @param array $parameters
	 * @return stdClass
	 */
	public function request($url, $parameters) {
		$returnParams = new stdClass();
		$returnParams->url = $url;
		foreach($parameters as $name => $value){
			$returnParams->$name = $value;
		}
		
		return $returnParams;
	}

}
