<?php

namespace Platron\PhpSdk\tests\unit\request\request_builders;

use Platron\PhpSdk\request\request_builders\GetReceiptStatusBuilder;

class GetReceiptStatusBuilderTest
{
	public function testExecute()
	{
		$requestBuilder1 = new GetReceiptStatusBuilder('34442335');
		$requestBuilderParameters = $requestBuilder1->getParameters();
		$this->assertEquals('34442335', $requestBuilderParameters['pg_receipt_id']);
	}
}