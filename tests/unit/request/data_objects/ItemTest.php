<?php

namespace Platron\PhpSdk\tests\unit;

use PHPUnit_Framework_TestCase;
use Platron\PhpSdk\request\data_objects\Item;
use Platron\PhpSdk\Exception;

class ItemTest extends PHPUnit_Framework_TestCase
{

	public function testGetParameters()
	{
		$item = new Item('test product', '10.00', 2, Item::VAT0);
		$item->addAmount('20.00');
		$item->addType(Item::TYPE_WORK);
		$item->addPaymentType(Item::PAYMENT_FULL_PAYMENT);

		$agentName = 'TestAgent';
		$agentInn = '123456789012';
		$agentPhone = '79050000000';
		$item->addAgent(Item::AGENT_TYPE_COMMISSIONAIRE, $agentName, $agentInn, $agentPhone);

		$parameters = $item->getParameters();
		$this->assertEquals('test product', $parameters['pg_label']);
		$this->assertEquals('10.00', $parameters['pg_price']);
		$this->assertEquals(2, $parameters['pg_quantity']);
		$this->assertEquals('20.00', $parameters['pg_amount']);
		$this->assertEquals(Item::VAT0, $parameters['pg_vat']);
		$this->assertEquals(Item::TYPE_WORK, $parameters['pg_type']);
		$this->assertEquals(Item::PAYMENT_FULL_PAYMENT, $parameters['pg_payment_type']);
		$this->assertEquals(Item::AGENT_TYPE_COMMISSIONAIRE, $parameters['pg_agent_type']);
		$this->assertEquals($agentName, $parameters['pg_agent_name']);
		$this->assertEquals($agentInn, $parameters['pg_agent_inn']);
		$this->assertEquals($agentPhone, $parameters['pg_agent_phone']);
	}

	/**
	 * @param $productName
	 * @param $price
	 * @param $quantity
	 * @param $vat
	 * @return bool
	 *
	 * @return bool
	 * @dataProvider wrongVatProvider
	 */
	public function testExceptionSetVat($productName, $price, $quantity, $vat)
	{
		try {
			new Item($productName, $price, $quantity, $vat);
		} catch (Exception $ex) {
			return true;
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function wrongVatProvider()
	{
		return array(
			array('test product', '10.00', 2, 'wrong value'),
			array('test product', '10.00', 2, '18'),
			array('test product', '10.00', 2, '18/118'),
		);
	}
}
