<?php

namespace Platron\PhpSdk\tests\integration;


use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\MoneybackSystemListBuilder;

/*
 * Интеграционный тест запроса списка систем для выплат
 */

class GetMoneybackSystemsListTest extends IntegrationTestBase {
	public function testGetMoneybackSystemsList() {
		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$moneybackSystemsListBuilder = new MoneybackSystemListBuilder();
		$response = $postClient->request($moneybackSystemsListBuilder);
		$this->assertTrue(isset($response->pg_contract_list));
	}
}