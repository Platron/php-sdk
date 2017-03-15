<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\commands\GetMoneybackStatus;

class GetMoneybackStatusTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'sdfsbsngfsgtbbtr');
		$command = new GetMoneybackStatus('3344');
		
		$this->assertEquals('3344', $command->execute($client)->pg_moneyback_id);
	}
}
