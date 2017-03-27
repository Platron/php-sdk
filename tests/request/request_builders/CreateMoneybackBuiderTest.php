<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\CreateMoneybackBuilder;

class CreateMoneybackBuiderTest extends \PHPUnit_Framework_TestCase {

	public function testExecute() {
		$requestBuilder = new CreateMoneybackBuilder('346536', 'YANDEXMONEY_O', '10.00', 'test', array('destination_account' => '3454353453543'));
		$requestBuilder->bindToTransaction('3453523');
		$requestBuilderParameters = $requestBuilder->getParameters();
				
		$this->assertEquals('346536', $requestBuilderParameters['pg_contract_id']);
		$this->assertEquals('YANDEXMONEY_O', $requestBuilderParameters['pg_moneyback_system']);
		$this->assertEquals('10.00', $requestBuilderParameters['pg_amount']);
		$this->assertEquals('test', $requestBuilderParameters['pg_description']);
		$this->assertEquals('3454353453543', $requestBuilderParameters['destination_account']);
		$this->assertEquals('3453523', $requestBuilderParameters['pg_payment_id']);
	}
	
	
}
