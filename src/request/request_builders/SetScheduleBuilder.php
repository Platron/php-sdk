<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\data_objects\ScheduleTemplate;

class SetScheduleBuilder extends RequestBuilder
{
	const
		INTERVAL_DAY = 'day',
		INTERVAL_WEEK = 'week',
		INTERVAL_MONTH = 'month';

	/** @var int */
	protected $pg_merchant_id;
	/** @var int */
	protected $pg_recurring_profile;
	/** @var double */
	protected $pg_amount;
	/** @var string[] */
	protected $pg_dates;
	/** @var string */
	protected $pg_template;

	/**
	 * @return string
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'index.php/api/recurring/set-schedule';
	}

	/**
	 * SetScheduleBuilder constructor.
	 * @param int $merchantId
	 * @param int $recurringProfile
	 * @param double $amount
	 */
	public function __construct($merchantId, $recurringProfile, $amount)
	{
		$this->pg_merchant_id = $merchantId;
		$this->pg_recurring_profile = $recurringProfile;
		$this->pg_amount = $amount;
	}

	/**
	 * @param \DateTime $dates
	 */
	public function addDate(\DateTime $dates)
	{
		$this->pg_dates[] = $dates->format('Y-m-d H:i:s');
	}

	/**
	 * ScheduleTemplate constructor.
	 * @param \DateTime $startDate
	 * @param string $interval
	 * @param int $period
	 * @param int $maxPeriods
	 * @throws Exception
	 */
	public function addTemplate(\DateTime $startDate, $interval, $period, $maxPeriods = null)
	{
		if(!in_array($interval, $this->getPossibleIntervals())){
			throw new Exception('Wrong interval type. Use from constants');
		}

		$this->pg_template['pg_start_date'] = $startDate->format('Y-m-d H:i:s');
		$this->pg_template['pg_interval'] = $interval;
		$this->pg_template['pg_period'] = $period;
		$this->pg_template['pg_max_periods'] = $maxPeriods;
	}

	/**
	 * @return array
	 */
	private function getPossibleIntervals()
	{
		return array(
			self::INTERVAL_DAY,
			self::INTERVAL_WEEK,
			self::INTERVAL_MONTH,
		);
	}
}