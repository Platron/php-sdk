<?php

namespace Platron\PhpSdk\tests\unit;

use PHPUnit_Framework_TestCase;
use Platron\PhpSdk\request\data_objects\Item;
use Platron\PhpSdk\Exception;

class ItemTest extends PHPUnit_Framework_TestCase {
	
	public function testGetParameters(){
		$item = new Item('test product', '10.00', 2, Item::VAT0);
		$item->addAmount('20.00');
		$item->addType('product');
		
		$parameters = $item->getParameters();
		$this->assertEquals('test product', $parameters['pg_label']);
		$this->assertEquals('10.00', $parameters['pg_price']);
		$this->assertEquals(2, $parameters['pg_quantity']);
		$this->assertEquals('20.00', $parameters['pg_amount']);
		$this->assertEquals(Item::VAT0, $parameters['pg_vat']);
		$this->assertEquals('product', $parameters['pg_type']);
	}
	
	public function testExceptionSetVat(){
		try {
			new Item('test product', '10.00', 2, 'wrong value');
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
	
}
