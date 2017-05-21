<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\data_objects\AviaGds;

class AviaGdsTest extends \PHPUnit_Framework_TestCase {
	public function testGetParameters(){
		$dataObject = new AviaGds('GGG666', 'SABRE', '10.00');
		$dataObject->addCardBrands(array('VI', 'CA'));
		
		$params = $dataObject->getParameters();
		
		$this->assertEquals('GGG666', $params['pg_rec_log']);
		$this->assertEquals('SABRE', $params['pg_gds']);
		$this->assertEquals('10.00', $params['pg_merchant_markup']);
		$this->assertEquals('VI', $params['pg_card_brand'][0]);
		$this->assertEquals('CA', $params['pg_card_brand'][1]);
	}
}
