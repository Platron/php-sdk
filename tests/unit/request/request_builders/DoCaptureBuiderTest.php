<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\DoCaptureBuilder;

class DoCaptureBuiderTest extends \PHPUnit_Framework_TestCase
{
	public function testExecute()
	{
		$stubLongRecord = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\LongRecord')->disableOriginalConstructor()->setMethods(array('getParameters'))->getMock();
		$stubLongRecord->expects($this->any())->method('getParameters')->willReturn(array('long_record_param' => 'test'));

		$requestBuilder = new DoCaptureBuilder('343242');
		$requestBuilder->addLongRecord($stubLongRecord);
		$requestBuilderParameters = $requestBuilder->getParameters();

		$this->assertEquals('343242', $requestBuilderParameters['pg_payment_id']);
		$this->assertEquals('test', $requestBuilderParameters['long_record_param']);
	}
}
