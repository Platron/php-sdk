<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\PsListBuilder;

/**
 * Интеграционный тест запроса списка платежных систем
 */
class PsListTest extends IntegrationTestBase
{
	public function testPsList()
	{
		$postClient = new PostClient($this->merchantId, $this->secretKey);

		$psListBuilder = new PsListBuilder('10.00');
		$psListResponse = $postClient->request($psListBuilder);
		$this->assertEquals('ok', $psListResponse->pg_status);
	}
}
