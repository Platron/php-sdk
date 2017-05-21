<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\data_objects\LongRecord;
use Platron\PhpSdk\Exception;

class LongRecordTest extends \PHPUnit_Framework_TestCase {
	public function testGetParameters(){
		$dataObject = new LongRecord('alexey lashnev', 'FFF666', '1');
		$dataObject->setAgencyCode('F');
		$dataObject->setTicketSystem('GAT');
		
		$stubTripleg = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\LongRecordTripleg')->disableOriginalConstructor()->setMethods(array('getParameters'))->getMock();
		$stubTripleg->expects($this->any())->method('getParameters')->willReturn(array('tripleg_param' => 'test'));

		$dataObject->addTripLeg($stubTripleg);
		$params = $dataObject->getParameters();
		
		$this->assertEquals('alexey lashnev', $params['pg_ticket_passenger_name']);
		$this->assertEquals('FFF666', $params['pg_ticket_number']);
		$this->assertEquals('1', $params['pg_ticket_restricted']);
		$this->assertEquals('F', $params['pg_ticket_agency_code']);
		$this->assertEquals('GAT', $params['pg_ticket_system']);
		$this->assertEquals('test', $params['tripleg_param']);
	}
	
	public function testMore4TriplegExceptions(){
		$stubTripleg = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\LongRecordTripleg')->disableOriginalConstructor()->getMock();
		
		$dataObject = new LongRecord('alexey lashnev', 'FFF666', '1');
		$dataObject->addTripLeg($stubTripleg)->addTripLeg($stubTripleg)->addTripLeg($stubTripleg)->addTripLeg($stubTripleg);
		try {
			$dataObject->addTripLeg($stubTripleg);
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
}
