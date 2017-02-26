<?php

namespace platron_sdk\request\commands;

use platron_sdk\request\data_objects\LongRecord;

/**
 * Команда для проведения клиринга по транзакции. Для возможности работы по двухстадийной схеме нужно связаться с менеджером
 */
class DoCapture extends BaseCommand {

	/** @var int Id платежа */
	protected $pg_payment_id;

	/** @var LongRecord Длинная запись */
	protected $longRecord;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'do_capture.php';
	}

	/**
	 * @inheritdoc
	 */
	protected function getParameters() {
		$parameters = array();
		$parameters['pg_payment_id'] = $this->pg_payment_id;

		if (!empty($this->longRecord)) {
			foreach ($this->longRecord->getParameters() as $name => $value) {
				if ($value) {
					$parameters[$name] = $value;
				}
			}
		}

		return $parameters;
	}

	/**
	 * @param int $payment Id платежа
	 */
	public function __construct($payment) {
		$this->pg_payment_id = $payment;
	}

	/**
	 * Добавить длинную запись к клирингу
	 * @param LongRecord $longRecord
	 */
	public function addLongRecord(LongRecord $longRecord) {
		$this->longRecord = $longRecord;
	}

}
