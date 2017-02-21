<?php

namespace platron_sdk\request\clients;

interface iClient {
	
	/**
	 * @param int $merchant
	 * @param string $secretKey
	 */
	public function __construct($merchant, $secretKey);
	
	/**
	 * @param string $url
	 * @param array $parameters
	 */
	public function request($url, $parameters);
}
