<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\request_builders\DoCaptureBuilder;

/*
 * Интеграционный тест создания и клиринга транзакции
 */

class DoCaptureTest extends PaidTransactionTestBase
{
	/** @var int */
	protected $paymentId;

	public function getInitPaymentBuilder()
	{
		$factory = new InitPaymentBuilderFactory();
		return $factory->createForTestCardPaymentSystem();
	}

	public function testCapture()
	{
		$doCaptureBuilder = new DoCaptureBuilder($this->paymentId);
		$captureResponse = $this->postClient->request($doCaptureBuilder);
		$this->assertEquals('ok', $captureResponse->pg_status);
	}
}