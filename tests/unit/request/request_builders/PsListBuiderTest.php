<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\PsListBuilder;

class PsListBuiderTest extends \PHPUnit_Framework_TestCase
{
	public function testExecute()
	{
		$requestBuilder = new PsListBuilder('10.00');
		$requestBuilder->addCurrency('RUB');
		$requestBuilder->addTestingMode();
		$requestBuilderParameters = $requestBuilder->getParameters();

		$this->assertEquals('10.00', $requestBuilderParameters['pg_amount']);
		$this->assertEquals('RUB', $requestBuilderParameters['pg_currency']);
		$this->assertEquals(1, $requestBuilderParameters['pg_testing_mode']);
	}
}
