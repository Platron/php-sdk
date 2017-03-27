<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\RevokeBuilder;

class RevokeBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'dfsvjsfdsdfvshjvjk');
		$command = new RevokeBuilder('3444223');
		$command->setAmount('10.00');
		
		$this->assertEquals('3444223', $command->execute($client)->pg_payment_id);
		$this->assertEquals('10.00', $command->execute($client)->pg_refund_amount);
	}
}
