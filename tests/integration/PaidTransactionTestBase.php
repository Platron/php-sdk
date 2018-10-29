<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\GetStatusBuilder;

abstract class PaidTransactionTestBase extends IntegrationTestBase
{
	const ITERATION_COUNT = 5;
	const WAITING_TIME = 2;
	/** @var GetStatusBuilder */
	private $getStatusBuilder;
	/** @var PostClient */
	private $postClient;

	/*
	 * @return InitPaymentBuilder
	 */

	public function setUp()
	{
		parent::setUp();

		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$this->postClient = $postClient;

		$initPaymentBuilder = $this->getInitPaymentBuilder();
		$this->paymentId = (int)$postClient->request($initPaymentBuilder)->pg_payment_id;

		$this->getStatusBuilder = new GetStatusBuilder($this->paymentId);
		$this->waitForTransaction();
	}

	abstract private function getInitPaymentBuilder();

	/*
	 * Ожидание успешного завершения платежа
	 */

	public function waitForTransaction()
	{
		for ($i = 0; $i < static::ITERATION_COUNT; $i++) {
			$response = $this->postClient->request($this->getStatusBuilder);
			$status = $response->pg_transaction_status;
			if ($status == 'ok') {
				return;
			}
			sleep(static::WAITING_TIME);
		}
		$this->markTestSkipped('Unable to process transaction');
	}
}