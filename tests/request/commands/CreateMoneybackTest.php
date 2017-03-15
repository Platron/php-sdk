<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\commands\CreateMoneyback;

class CreateMoneybackTest extends \PHPUnit_Framework_TestCase {

	public function testExecute() {
		$client = new ClientToHelpTest('82', 'fdsvsdfvfsdvsfd');
		$command = new CreateMoneyback('346536', 'YANDEXMONEY_O', '10.00', 'test', array('destination_account' => '3454353453543'));
		$command->bindToTransaction('3453523');
		
		$this->assertEquals('346536', $command->execute($client)->pg_contract_id);
		$this->assertEquals('YANDEXMONEY_O', $command->execute($client)->pg_moneyback_system);
		$this->assertEquals('10.00', $command->execute($client)->pg_amount);
		$this->assertEquals('test', $command->execute($client)->pg_description);
		$this->assertEquals('3454353453543', $command->execute($client)->destination_account);
		$this->assertEquals('3453523', $command->execute($client)->pg_payment_id);
	}
	
	
}
