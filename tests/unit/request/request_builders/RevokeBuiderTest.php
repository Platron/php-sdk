<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\RevokeBuilder;

class RevokeBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$requestBuilder = new RevokeBuilder('3444223');
		$requestBuilder->setAmount('10.00');
		$requestBuilderParameters = $requestBuilder->getParameters();
		
		$this->assertEquals('3444223', $requestBuilderParameters['pg_payment_id']);
		$this->assertEquals('10.00', $requestBuilderParameters['pg_refund_amount']);
	}
}
