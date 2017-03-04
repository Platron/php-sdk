<?php

namespace platron_sdk\request\clients;

use platron_sdk\SigHelper;

interface iClient {

	/**
	 * @param int $merchant
	 * @param string $secretKey
	 */
	public function __construct($merchant, SigHelper $sigHelper);

	/**
	 * @param string $url
	 * @param array $parameters
	 */
	public function request($url, $parameters);
}
