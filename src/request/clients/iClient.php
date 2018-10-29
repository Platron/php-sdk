<?php

namespace Platron\PhpSdk\request\clients;

use Platron\PhpSdk\request\request_builders\RequestBuilder;

interface iClient
{

	/**
	 * @param int $merchant
	 * @param string $secretKey
	 */
	public function __construct($merchant, $secretKey);

	/**
	 * @param RequestBuilder $requestBuilder
	 */
	public function request(RequestBuilder $requestBuilder);
}
