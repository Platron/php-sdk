<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\CancelBuilder;

class CancelBuilderTest extends \PHPUnit_Framework_TestCase {

	public function testExecute(){
		$client = new ClientToHelpTest('82', 'hjbhjbjhbhj');
		$command = new CancelBuilder('363654');
		$this->assertEquals('363654', $command->execute($client)->pg_payment_id);
	}
}
