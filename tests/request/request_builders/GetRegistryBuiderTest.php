<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\GetRegistryBuilder;

class GetRegistryBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'fdfsdssssssfdgfsd');
		$command = new GetRegistryBuilder(new \DateTime('2016-01-01'));
		
		$this->assertEquals('2016-01-01', $command->execute($client)->pg_date);
	}
}
