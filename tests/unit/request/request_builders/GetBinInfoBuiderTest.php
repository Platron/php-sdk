<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\GetBinInfoBuilder;

class GetBinInfoBuiderTest extends \PHPUnit_Framework_TestCase
{
	public function testExecute()
	{
		$requestBuilder = new GetBinInfoBuilder('444555');
		$requestBuilderParameters = $requestBuilder->getParameters();

		$this->assertEquals('444555', $requestBuilderParameters['pg_bin']);
	}
}
