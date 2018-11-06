<?php

namespace Platron\PhpSdk\tests\unit\request\request_builders;

use Platron\PhpSdk\request\data_objects\ScheduleTemplate;
use Platron\PhpSdk\request\request_builders\SetScheduleBuilder;

class SetScheduleBuilderTest extends \PHPUnit_Framework_TestCase
{
	public function testGetParametersWithDates()
	{
		$merchantId = '82';
		$recurringProfile = '231231';
		$amount = '10.00';

		$templateRequest = new SetScheduleBuilder($merchantId, $recurringProfile, $amount);
		$dates = array('2020-01-01');
		$templateRequest->addDates($dates);
		$parameters = $templateRequest->getParameters();
		$this->assertEquals($merchantId, $parameters['pg_merchant_id']);
		$this->assertEquals($recurringProfile, $parameters['pg_recurring_profile']);
		$this->assertEquals($amount, $parameters['pg_amount']);
		$this->assertEquals($dates[0], $parameters['pg_dates'][0]);
	}

	public function testGetParametersWithTemplate()
	{
		$startDate = '2020-01-01';
		$period = 10;
		$maxPeriods = 10;
		$templateRequest = new SetScheduleBuilder('82', '231231', '10.00');
		$templateRequest->addTemplate($startDate, SetScheduleBuilder::INTERVAL_WEEK, $period, $maxPeriods);
		$parameters = $templateRequest->getParameters();
		$this->assertEquals($startDate, $parameters['pg_template']['pg_start_date']);
		$this->assertEquals(SetScheduleBuilder::INTERVAL_WEEK, $parameters['pg_template']['pg_interval']);
		$this->assertEquals($period, $parameters['pg_template']['pg_period']);
		$this->assertEquals($maxPeriods, $parameters['pg_template']['pg_max_periods']);
	}
}