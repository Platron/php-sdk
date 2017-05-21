<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\GetStatusBuilder;

/**
 * Интеграционный тест создания транзакции и запроса по ней статуса
 */
class CreateTransactionGesStatusTest extends IntegrationTestBase {
	public function testCreateTransactionGetStatus(){
		$postClient = new PostClient($this->merchantId, $this->secretKey);
		
		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
		$initPaymentResponse = $postClient->request($initPaymentBuilder);	
		$this->assertEquals('ok', $initPaymentResponse->pg_status);
		
		$getStatusBuilder = new GetStatusBuilder((string)$initPaymentResponse->pg_payment_id);
		$getStatusResponse = $postClient->request($getStatusBuilder);
		$this->assertEquals('ok', $getStatusResponse->pg_status);
	}
}
