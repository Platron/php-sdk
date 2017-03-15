<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\commands\CreateRefundRequest;

class CreateRefundRequestTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'sdfbsffsdbsffsd');
		$command = new CreateRefundRequest('34324324', '10.00', 'test');
		
		$this->assertEquals('34324324', $command->execute($client)->pg_payment_id);
		$this->assertEquals('10.00', $command->execute($client)->pg_refund_amount);
		$this->assertEquals('test', $command->execute($client)->pg_comment);
	}
}
