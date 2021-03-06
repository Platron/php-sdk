<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\request\data_objects\LongRecord;

/**
 * Строитель для проведения клиринга по транзакции. Для возможности работы по двухстадийной схеме нужно связаться с менеджером
 */
class DoCaptureBuilder extends RequestBuilder
{

	/** @var int Id платежа */
	protected $pg_payment_id;

	/** @var LongRecord Длинная запись */
	protected $longRecord;

	/** @var double Сумма частичного клиринга */
	protected $pg_amount;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'do_capture.php';
	}

	/**
	 * @inheritdoc
	 */
	public function getParameters()
	{
		$parameters = array();
		$parameters['pg_payment_id'] = $this->pg_payment_id;

		if (!empty($this->longRecord)) {
			foreach ($this->longRecord->getParameters() as $name => $value) {
				if ($value) {
					$parameters[$name] = (string)$value;
				}
			}
		}

		if($this->pg_amount){
			$parameters['pg_amount'] = $this->pg_amount;
		}

		return $parameters;
	}

	/**
	 * @param int $payment Id платежа
	 */
	public function __construct($payment)
	{
		$this->pg_payment_id = $payment;
	}

	/**
	 * Добавить длинную запись к клирингу. Для использования длинной записи нужно согласовать это с менеджером
	 * @param LongRecord $longRecord
	 */
	public function addLongRecord(LongRecord $longRecord)
	{
		$this->longRecord = $longRecord;
	}

	/**
	 * @param double $amount
	 */
	public function addAmount($amount)
	{
		$this->pg_amount = $amount;
	}

}
