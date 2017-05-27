<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\CreateReceiptBuilder;
use Platron\PhpSdk\Exception;

class CreateReceiptBuilderTest extends \PHPUnit_Framework_TestCase {
	public function testGetParameters(){		
		$itemStub = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\Item')->disableOriginalConstructor()->setMethods(array())->getMock();
		$itemStub->expects($this->any())->method('getParameters')->willReturn(array('item_parameter' => 'test'));
		
		$createReceiptBuilder = new CreateReceiptBuilder(CreateReceiptBuilder::TRANSACTION_TYPE, 100500, 100501);
		$createReceiptBuilder->addItem($itemStub);
		
		$parameters = $createReceiptBuilder->getParameters();
		$itemParameters = $parameters['pg_items'][0];
		
		$this->assertEquals(CreateReceiptBuilder::TRANSACTION_TYPE, $parameters['pg_operation_type']);
		$this->assertEquals(100500, $parameters['pg_payment_id']);
		$this->assertEquals(100501, $parameters['pg_order_id']);
		$this->assertEquals('test', $itemParameters['item_parameter']);
	}
	
	public function testExceptionSetOperationType(){
		try {
			new CreateReceiptBuilder('wrong value', 100500, 100501);
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
	
	public function testExceptionEmptyTransactionAndOrder(){
		try {
			new CreateReceiptBuilder(CreateReceiptBuilder::TRANSACTION_TYPE);
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
}
