<?php

namespace platron_sdk\tests;

use platron_sdk\request\data_objects\LongRecordTripleg;

class LongRecordTriplegTest extends \PHPUnit_Framework_TestCase {
	public function testGetParameters(){
		$dataObject = new LongRecordTripleg(1, '2017-01-01', 'SU', 'E', 'KRR', 'VKO', 'X', 'NVOR', '6062');
		
		$parameters = $dataObject->getParameters();
		
		$this->assertEquals('2017-01-01', $parameters['pg_tripleg_1_date']);
		$this->assertEquals('SU', $parameters['pg_tripleg_1_carrier']);
		$this->assertEquals('E', $parameters['pg_tripleg_1_class']);
		$this->assertEquals('KRR', $parameters['pg_tripleg_1_destination_from']);
		$this->assertEquals('VKO', $parameters['pg_tripleg_1_destination_to']);
		$this->assertEquals('X', $parameters['pg_tripleg_1_stopover']);
		$this->assertEquals('NVOR', $parameters['pg_tripleg_1_fare_basis_code']);
		$this->assertEquals('6062', $parameters['pg_tripleg_1_flight_number']);
	}
}
