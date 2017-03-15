<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\commands\PsList;

class PsListTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'sfdbjhsfvbshjd');
		$command = new PsList('10.00');
		$command->addCurrency('RUB');
		$command->addTestingMode();
		
		$this->assertEquals('10.00', $command->execute($client)->pg_amount);
		$this->assertEquals('RUB', $command->execute($client)->pg_currency);
		$this->assertEquals(1, $command->execute($client)->pg_testing_mode);
	}
}
