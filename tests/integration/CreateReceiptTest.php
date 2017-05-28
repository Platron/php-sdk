<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\ReceiptBuilder;
use Platron\PhpSdk\request\data_objects\Item;

class CreateReceiptTest extends IntegrationTestBase {
	/** @var int */
	protected $paymentId;
	
	/** @var PostClient */
	protected $postClient;
	
	public function setUp() {
		parent::setUp();
		
		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$this->postClient = $postClient;
		
		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
		$this->paymentId = (int)$postClient->request($initPaymentBuilder)->pg_payment_id;
	}
	
	public function testCreateReceipt(){
		$item = new Item('Тестовый товар', '10.00', 1);
		$createReceiptBuilder = new ReceiptBuilder(ReceiptBuilder::TRANSACTION_TYPE, $this->paymentId);
		$createReceiptBuilder->addItem($item);
		$createReceiptResponse = $this->postClient->request($createReceiptBuilder);
		$this->assertEquals('ok', $createReceiptResponse->pg_status);
	}
}
