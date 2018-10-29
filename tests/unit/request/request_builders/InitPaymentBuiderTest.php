<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\Exception;

class InitPaymentBuiderTest extends \PHPUnit_Framework_TestCase
{
	public function testGetParameters()
	{
		$requestBuilder = new InitPaymentBuilder('10.00', 'test');

		$bankCardStub = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\BankCard')->disableOriginalConstructor()->setMethods(array())->getMock();
		$bankCardStub->expects($this->any())->method('getParameters')->willReturn(array('bank_card_parameter' => 'test'));

		$aviaGdsStub = $this->getMockBuilder('Platron\PhpSdk\request\data_objects\AviaGds')->disableOriginalConstructor()->setMethods(array())->getMock();
		$aviaGdsStub->expects($this->any())->method('getParameters')->willReturn(array('avia_gds_parameter' => 'test'));

		$requestBuilder->addBankCard($bankCardStub)
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

		$requestBuilderParameters = $requestBuilder->getParameters();

		$this->assertEquals('test', $requestBuilderParameters['bank_card_parameter']);
		$this->assertEquals('www.site.ru/capture.php', $requestBuilderParameters['pg_capture_url']);
		$this->assertEquals('www.site.ru/check.php', $requestBuilderParameters['pg_check_url']);
		$this->assertEquals('RUB', $requestBuilderParameters['pg_currency']);
		$this->assertEquals('www.site.ru/failure.php', $requestBuilderParameters['pg_failure_url']);
		$this->assertEquals('POST', $requestBuilderParameters['pg_failure_url_method']);
		$this->assertEquals('test', $requestBuilderParameters['avia_gds_parameter']);
		$this->assertEquals(604800, $requestBuilderParameters['pg_lifetime']);
		$this->assertEquals('test', $requestBuilderParameters['merchant_param']);
		$this->assertEquals('555', $requestBuilderParameters['pg_order_id']);
		$this->assertEquals('RUSSIANSTANDARD', $requestBuilderParameters['pg_payment_system']);
		$this->assertEquals(1, $requestBuilderParameters['pg_postpone']);
		$this->assertEquals(111333, $requestBuilderParameters['pg_alfaclick_client_id']);
		$this->assertEquals(1, $requestBuilderParameters['pg_recurring_start']);
		$this->assertEquals('www.site.ru/refund.php', $requestBuilderParameters['pg_refund_url']);
		$this->assertEquals('POST', $requestBuilderParameters['pg_request_method']);
		$this->assertEquals('www.site.ru/result.php', $requestBuilderParameters['pg_result_url']);
		$this->assertEquals('www.site.ru', $requestBuilderParameters['pg_site_url']);
		$this->assertEquals('www.site.ru/state.php', $requestBuilderParameters['pg_state_url']);
		$this->assertEquals('POST', $requestBuilderParameters['pg_state_url_method']);
		$this->assertEquals('www.site.ru/success.php', $requestBuilderParameters['pg_success_url']);
		$this->assertEquals('POST', $requestBuilderParameters['pg_success_url_method']);
		$this->assertEquals(1, $requestBuilderParameters['pg_testing_mode']);
		$this->assertEquals('test@test.ru', $requestBuilderParameters['pg_user_contact_email']);
		$this->assertEquals('62.213.64.221', $requestBuilderParameters['pg_user_ip']);
		$this->assertEquals('79268750000', $requestBuilderParameters['pg_user_phone']);
	}

	public function testExceptionAddMerchantParams()
	{
		$requestBuilder = new InitPaymentBuilder('10.00', 'test');
		try {
			$requestBuilder->addMerchantParams(array('pg_some_param' => 'test'));
		} catch (Exception $ex) {
			return true;
		}

		return false;
	}

	public function testExceptionAddPsAdditionalParameters()
	{
		$requestBuilder = new InitPaymentBuilder('10.00', 'test');
		try {
			$requestBuilder->addPaymentSystem(array('some_param' => 'test'));
		} catch (Exception $ex) {
			return true;
		}

		return false;
	}
}
