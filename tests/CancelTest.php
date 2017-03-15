<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\commands\Cancel;

class CancelTest extends \PHPUnit_Framework_TestCase {

	public function testExecute(){
		$client = new ClientToHelpTest('82', 'hjbhjbjhbhj');
		$command = new Cancel('363654');
		$this->assertEquals('363654', $command->execute($client)->pg_payment_id);
	}
}
