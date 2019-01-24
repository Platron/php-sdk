<?php

namespace Platron\PhpSdk\tests\unit\request\request_builders;

use Platron\PhpSdk\request\request_builders\GetReceiptStatus;

class GetReceiptStatusBuilderTest
{
	public function testExecute()
	{
		$requestBuilder1 = new GetReceiptStatus('34442335');
		$requestBuilderParameters = $requestBuilder1->getParameters();
		$this->assertEquals('34442335', $requestBuilderParameters['pg_receipt_id']);
	}
}