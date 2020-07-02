<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\ReceiptBuilder;
use Platron\PhpSdk\request\data_objects\Item;

class CreateReceiptTest extends IntegrationTestBase
{
	/** @var int */
	protected $paymentId;

	/** @var PostClient */
	protected $postClient;

	public function setUp()
	{
		parent::setUp();

		$postClient = new PostClient($this->merchantId, $this->secretKey);
		$this->postClient = $postClient;

		$initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
		$initPaymentBuilder->addTestingMode();
		$this->paymentId = (int)$postClient->request($initPaymentBuilder)->pg_payment_id;
	}

	public function testCreateReceipt()
	{
		$item = new Item('Test product', 10.00, 1);
		$item->addAmount(10.00);
		$item->addType(Item::TYPE_WORK);
		$item->addAgent(Item::AGENT_TYPE_AGENT, 'agent name', 7707357618, 79999999999);
		$nomenclatureCode = '44h4Dh04h2Fh1Fh96h81h78h4Ah67h58h4Ah35h2Eh54h31h31h32h30h30h30h';
		$item->addNomenclatureCode($nomenclatureCode);
		$item->addPaymentType(Item::PAYMENT_FULL_PAYMENT);

		$createReceiptBuilder = new ReceiptBuilder(ReceiptBuilder::TRANSACTION_TYPE, $this->paymentId);
		$createReceiptBuilder->addItem($item);
		$createReceiptResponse = $this->postClient->request($createReceiptBuilder);
		$this->assertEquals('ok', $createReceiptResponse->pg_status);
	}
}
