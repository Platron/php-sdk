<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\PsListBuilder;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\GetStatusBuilder;

class CreateTransactionChainTest extends IntegrationTestBase {
	public function testCreateTransactionChain(){
		$postClient = new PostClient($this->merchantId, $this->secretKey);
		
		$psListBuilder = new PsListBuilder('10.00');
		$psListResponse = $postClient->request($psListBuilder);
		$this->assertEquals('ok', $psListResponse->pg_status);
		
		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test sdk');
		$initPaymentResponse = $postClient->request($initPaymentBuilder);	
		$this->assertEquals('ok', $initPaymentResponse->pg_status);
		
		$getStatusBuilder = new GetStatusBuilder($initPaymentResponse->pg_payment_id);
		$getStatusResponse = $postClient->request($getStatusBuilder);
		$this->assertEquals('ok', $getStatusResponse->pg_status);
	}
}
