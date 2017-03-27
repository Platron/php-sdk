<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\GetStatusBuilder;

class GetStatusBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'fdsvsdfvsfdsbs');
		$command1 = new GetStatusBuilder('34442335');
		$this->assertEquals('34442335', $command1->execute($client)->pg_payment_id);
		
		$command2 = new GetStatusBuilder(null, '4443');
		$this->assertEquals('4443', $command2->execute($client)->pg_order_id);
	}
}
