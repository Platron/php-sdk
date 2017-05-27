<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;

class CreateTransactionTest extends IntegrationTestBase {
	
	public function testCreateTransaction(){
		$postClient = new PostClient($this->merchantId, $this->secretKey);		
		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
		$this->assertNotEmpty((int)$postClient->request($initPaymentBuilder)->pg_payment_id);
	}
}
