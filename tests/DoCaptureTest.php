<?php

namespace platron_sdk\tests;

use platron_sdk\request\commands\DoCapture;

class DoCaptureTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		
		$stubLongRecord = $this->getMockBuilder('platron_sdk\request\data_objects\LongRecord')->disableOriginalConstructor()->setMethods(array('getParameters'))->getMock();
		$stubLongRecord->expects($this->any())->method('getParameters')->willReturn(array('long_record_param' => 'test'));
		
		$client = new ClientToHelpTest('82', 'sdfavsdfvsdfvsfd');
		$command = new DoCapture('343242');
		$command->addLongRecord($stubLongRecord);
		
		$this->assertEquals('343242', $command->execute($client)->pg_payment_id);
		$this->assertEquals('test', $command->execute($client)->long_record_param);
	}
}
