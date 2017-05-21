<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\data_objects\BankCard;

class BankCardTest extends \PHPUnit_Framework_TestCase {
	public function testGetParameters(){
		$dataObjects = new BankCard('4256000000000003', 'alexey lashnev', '2020', '01', '777', '62.213.64.221');
		
		$returnParameters = $dataObjects->getParameters();
		$this->assertEquals('4256000000000003', $returnParameters['pg_card_number']);
		$this->assertEquals('alexey lashnev', $returnParameters['pg_user_cardholder']);
		$this->assertEquals('2020', $returnParameters['pg_exp_year']);
		$this->assertEquals('01', $returnParameters['pg_exp_month']);
		$this->assertEquals('777', $returnParameters['pg_cvv2']);
		$this->assertEquals('62.213.64.221', $returnParameters['pg_user_ip']);
	}
}
