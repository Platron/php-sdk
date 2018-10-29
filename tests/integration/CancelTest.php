<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\CancelBuilder;

/**
 * Интеграционный тест отмены транзакции
 */
class CancelTest extends IntegrationTestBase
{
	/** @var int */
	private $paymentId;

	/** @var PostClient */
	private $postClient;

	public function setUp()
	{
		parent::setUp();

		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$this->postClient = $postClient;

		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
		$this->paymentId = (int)$postClient->request($initPaymentBuilder)->pg_payment_id;
	}

	public function testCancel()
	{
		$getStatusBuilder = new CancelBuilder($this->paymentId);
		$getStatusResponse = $this->postClient->request($getStatusBuilder);
		$this->assertEquals('ok', $getStatusResponse->pg_status);
	}
}
