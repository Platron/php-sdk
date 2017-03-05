<?php

namespace platron_sdk\tests;

use platron_sdk\request\commands\DoCapture;

class DoCaptureTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$longRecord = new \platron_sdk\request\data_objects\LongRecord('alexey lashnev', 'FFF666', '1');
		$longRecord->setAgencyCode('F');
		$longRecord->setTicketSystem('GAT');
		
		$tripleg1 = new \platron_sdk\request\data_objects\LongRecordTripleg(1, '2016-01-01', 'F', 'B', 'SVE', 'SVO', '1', 'B', '666');
		
		$longRecord->addTripLeg($tripleg1);
		
		$client = new ClientToHelpTest('82', 'sdfavsdfvsdfvsfd');
		$command = new DoCapture('343242');
		$command->addLongRecord($longRecord);
		
		$this->assertEquals('343242', $command->execute($client)->pg_payment_id);
		
		$this->assertEquals('alexey lashnev', $command->execute($client)->pg_ticket_passenger_name);
		$this->assertEquals('FFF666', $command->execute($client)->pg_ticket_number);
		$this->assertEquals('1', $command->execute($client)->pg_ticket_restricted);
		$this->assertEquals('F', $command->execute($client)->pg_ticket_agency_code);
		$this->assertEquals('GAT', $command->execute($client)->pg_ticket_system);
		
		$this->assertEquals('2016-01-01', $command->execute($client)->pg_tripleg_1_date);
		$this->assertEquals('F', $command->execute($client)->pg_tripleg_1_carrier);
		$this->assertEquals('B', $command->execute($client)->pg_tripleg_1_class);
		$this->assertEquals('SVE', $command->execute($client)->pg_tripleg_1_destination_from);
		$this->assertEquals('SVO', $command->execute($client)->pg_tripleg_1_destination_to);
		$this->assertEquals('1', $command->execute($client)->pg_tripleg_1_stopover);
		$this->assertEquals('B', $command->execute($client)->pg_tripleg_1_fare_basis_code);
		$this->assertEquals('666', $command->execute($client)->pg_tripleg_1_flight_number);
	}
}
