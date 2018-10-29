<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\GetRegistryBuilder;

class GetRegistryBuiderTest extends \PHPUnit_Framework_TestCase
{
	public function testExecute()
	{
		$requestBuilder = new GetRegistryBuilder(new \DateTime('2016-01-01'));
		$requestBuilderParameters = $requestBuilder->getParameters();

		$this->assertEquals('2016-01-01', $requestBuilderParameters['pg_date']);
	}
}
