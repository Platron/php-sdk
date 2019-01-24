<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\GetReceiptStatusBuilder;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\ReceiptBuilder;
use Platron\PhpSdk\request\data_objects\Item;

class GetReceiptStatusTest extends IntegrationTestBase
{
	/** @var int */
	protected $receiptId;

	/** @var PostClient */
	protected $postClient;

	public function setUp()
	{
		parent::setUp();

		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$this->postClient = $postClient;

		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
		$initPaymentBuilder->addTestingMode();
		$paymentId = (int)$postClient->request($initPaymentBuilder)->pg_payment_id;

		$item = new Item('Test product', 10.00, 1);
		$item->addAmount(10.00);

		$createReceiptBuilder = new ReceiptBuilder(ReceiptBuilder::TRANSACTION_TYPE, $paymentId);
		$createReceiptBuilder->addItem($item);
		$createReceiptResponse = $this->postClient->request($createReceiptBuilder);
		$this->receiptId = $createReceiptResponse->pg_receipt_id;
	}

	public function testCreateReceipt()
	{
		$getReceiptStatusBuilder = new GetReceiptStatusBuilder($this->receiptId);
		$getStatusReceiptResponse = $this->postClient->request($getReceiptStatusBuilder);
		$this->assertEquals('ok', $getStatusReceiptResponse->pg_status);
	}
}