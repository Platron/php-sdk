<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\GetBinInfoBuilder;

class GetBinInfoBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'sdfvfdfsdvsdv');
		$command = new GetBinInfoBuilder('444555');
		
		$this->assertEquals('444555', $command->execute($client)->pg_bin);
	}
}
