<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\GetRegistryBuilder;

/**
 * Интеграционный тест запроса реестра платежей
 */
class GetRegistryTest extends IntegrationTestBase
{

	public function testGetRegistry()
	{
		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$getStatusBuilder = new GetRegistryBuilder(new \DateTime('2017-01-01'));
		$getStatusResponse = $postClient->request($getStatusBuilder);
		$this->assertEquals('ok', $getStatusResponse->pg_status);
	}
}
