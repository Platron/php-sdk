<?php

namespace Platron\PhpSdk\tests\unit\request\request_builders;

use Platron\PhpSdk\request\data_objects\Item;
use Platron\PhpSdk\request\request_builders\ReceiptBuilder;

class ReceiptBuilderTest extends \PHPUnit_Framework_TestCase
{
	public function testGetParameters()
	{
		$pgPaymentId = '1234';
		$orderId = '234234';
		$itemName = 'Test';
		$additionalPaymentAmount = '10.00';

		$receipt = new ReceiptBuilder(ReceiptBuilder::TRANSACTION_TYPE, $pgPaymentId, $orderId);
		$item = new Item($itemName, '10', 1);
		$receipt->addItem($item);
		$receipt->addAdditionalPayment(ReceiptBuilder::ADDITIONAL_PAYMENT_PREPAYMENT, $additionalPaymentAmount);

		$parameters = $receipt->getParameters();
		$this->assertEquals(ReceiptBuilder::TRANSACTION_TYPE, $parameters['pg_operation_type']);
		$this->assertEquals($pgPaymentId, $parameters['pg_payment_id']);
		$this->assertEquals($orderId, $parameters['pg_order_id']);
		$this->assertEquals($itemName, $parameters['pg_items'][0]['pg_label']);
		$this->assertEquals(ReceiptBuilder::ADDITIONAL_PAYMENT_PREPAYMENT, $parameters['pg_additional_payment_type']);
		$this->assertEquals($additionalPaymentAmount, $parameters['pg_additional_payment_amount']);
	}
}