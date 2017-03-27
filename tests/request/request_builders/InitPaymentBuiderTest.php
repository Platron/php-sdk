<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\Exception;

class InitPaymentBuiderTest extends \PHPUnit_Framework_TestCase {
	public function testGetParameters(){
		$command = new InitPaymentBuilder('10.00', 'test');
		$client = new ClientToHelpTest('82', 'sdfavsdfvsdfvsfd');
		
		$bankCardStub = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\BankCard')->disableOriginalConstructor()->setMethods(array())->getMock();
		$bankCardStub->expects($this->any())->method('getParameters')->willReturn(array('bank_card_parameter' => 'test'));
		
		$aviaGdsStub = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\AviaGds')->disableOriginalConstructor()->setMethods(array())->getMock();
		$aviaGdsStub->expects($this->any())->method('getParameters')->willReturn(array('avia_gds_parameter' => 'test'));
		
		$command->addBankCard($bankCardStub)
				->addCaptureUrl('www.site.ru/capture.php')
				->addCheckUrl('www.site.ru/check.php')
				->addCurrency('RUB')
				->addFailureUrl('www.site.ru/failure.php')
				->addFailureUrlMethod('POST')
				->addGds($aviaGdsStub)
				->addLifetime(604800)
				->addMerchantParams(array('merchant_param' => 'test'))
				->addOrderId('555')
				->addPaymentSystem('RUSSIANSTANDARD')
				->addPostpone()
				->addPsAdditionalParameters(array('pg_alfaclick_client_id' => 111333))
				->addRecurringStart()
				->addRefundUrl('www.site.ru/refund.php')
				->addRequestMethod('POST')
				->addResultUrl('www.site.ru/result.php')
				->addSiteUrl('www.site.ru')
				->addStateUrl('www.site.ru/state.php')
				->addStateUrlMethod('POST')
				->addSuccessUrl('www.site.ru/success.php')
				->addSuccessUrlMethod('POST')
				->addTestingMode()
				->addUserEmail('test@test.ru')
				->addUserIp('62.213.64.221')
				->addUserPhone('79268750000');
		
		$this->assertEquals('test', $command->execute($client)->bank_card_parameter);
		$this->assertEquals('www.site.ru/capture.php', $command->execute($client)->pg_capture_url);
		$this->assertEquals('www.site.ru/check.php', $command->execute($client)->pg_check_url);
		$this->assertEquals('RUB', $command->execute($client)->pg_currency);
		$this->assertEquals('www.site.ru/failure.php', $command->execute($client)->pg_failure_url);
		$this->assertEquals('POST', $command->execute($client)->pg_failure_url_method);
		$this->assertEquals('test', $command->execute($client)->avia_gds_parameter);
		$this->assertEquals(604800, $command->execute($client)->pg_lifetime);
		$this->assertEquals('test', $command->execute($client)->merchant_param);
		$this->assertEquals('555', $command->execute($client)->pg_order_id);
		$this->assertEquals('RUSSIANSTANDARD', $command->execute($client)->pg_payment_system);
		$this->assertEquals(1, $command->execute($client)->pg_postpone);
		$this->assertEquals(111333, $command->execute($client)->pg_alfaclick_client_id);
		$this->assertEquals(1, $command->execute($client)->pg_recurring_start);
		$this->assertEquals('www.site.ru/refund.php', $command->execute($client)->pg_refund_url);
		$this->assertEquals('POST', $command->execute($client)->pg_request_method);
		$this->assertEquals('www.site.ru/result.php', $command->execute($client)->pg_result_url);
		$this->assertEquals('www.site.ru', $command->execute($client)->pg_site_url);
		$this->assertEquals('www.site.ru/state.php', $command->execute($client)->pg_state_url);
		$this->assertEquals('POST', $command->execute($client)->pg_state_url_method);
		$this->assertEquals('www.site.ru/success.php', $command->execute($client)->pg_success_url);
		$this->assertEquals('POST', $command->execute($client)->pg_success_url_method);
		$this->assertEquals(1, $command->execute($client)->pg_testing_mode);
		$this->assertEquals('test@test.ru', $command->execute($client)->pg_user_contact_email);
		$this->assertEquals('62.213.64.221', $command->execute($client)->pg_user_ip);
		$this->assertEquals('79268750000', $command->execute($client)->pg_user_phone);
	}
	
	public function testExceptionAddMerchantParams(){
		$command = new InitPaymentBuilder('10.00', 'test');
		try {
			$command->addMerchantParams(array('pg_some_param' => 'test'));
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
	
	public function testExceptionAddPsAdditionalParameters(){
		$command = new InitPaymentBuilder('10.00', 'test');
		try {
			$command->addPaymentSystem(array('some_param' => 'test'));
		} catch (Exception $ex) {
			return true;
		}
		
		return false;
	}
}
