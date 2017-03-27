<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\MakeRecurringBuilder;
use Platron\PhpSdk\Exception;

class MakeRecurringBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testExecute(){
		$client = new ClientToHelpTest('82', 'fadvhjvfblshdbvsldbv');
		$command = new MakeRecurringBuilder('4321', 'test');
		$command->addAmount('10.00')
			->addEncoding('UTF8')
			->addMerchantParams(array('merchant_param' => 'test'))
			->addOrderId('777944')
			->addRefundUrl('www.test.ru/refund.php')
			->addRequestMethod('POST')
			->addResultUrl('www.test.ru/result.php');
		
		$this->assertEquals('4321', $command->execute($client)->pg_recurring_profile);
		$this->assertEquals('test', $command->execute($client)->pg_description);
		
		$this->assertEquals('10.00', $command->execute($client)->pg_amount);
		$this->assertEquals('UTF8', $command->execute($client)->pg_encoding);
		$this->assertEquals('test', $command->execute($client)->merchant_param);
		$this->assertEquals('777944', $command->execute($client)->pg_order_id);
		$this->assertEquals('www.test.ru/refund.php', $command->execute($client)->pg_refund_url);
		$this->assertEquals('POST', $command->execute($client)->pg_request_method);
		$this->assertEquals('www.test.ru/result.php', $command->execute($client)->pg_result_url);
	}
	
	public function testExecuteMerchantParamsException(){
		$command = new MakeRecurringBuilder('4321', 'test');
		try {
			$command->addMerchantParams(array('pg_merchant_param' => 'test'));
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
}
