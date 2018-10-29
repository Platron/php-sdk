<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\GetMoneybackStatusBulder;

class GetMoneybackStatusBuiderTest extends \PHPUnit_Framework_TestCase
{
	public function testExecute()
	{
		$requestBuilder = new GetMoneybackStatusBulder('3344');
		$requestBuilderParameters = $requestBuilder->getParameters();

		$this->assertEquals('3344', $requestBuilderParameters['pg_moneyback_id']);
	}
}
