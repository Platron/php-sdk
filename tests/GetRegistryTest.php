<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\commands\GetRegistry;

class GetRegistryTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'fdfsdssssssfdgfsd');
		$command = new GetRegistry(new \DateTime('2016-01-01'));
		
		$this->assertEquals('2016-01-01', $command->execute($client)->pg_date);
	}
}
