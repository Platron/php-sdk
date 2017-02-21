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
		$parameters = [];
		$parameters['pg_payment_id'] = $this->pg_payment_id;
		
		if(!empty($this->longRecord)){
			foreach($this->longRecord->getParameters() as $name => $value){
				if($value){
					$parameters[$name] = $value;
				}
			}
		}
		
		return $parameters;
	}
	
	/**
	 * @param int $payment Id платежа
	 * @return $this
	 */
	public function __construct($payment) {
		$this->pg_payment_id = $payment;
		return $this;
	}
	
	/**
	 * Добавить длинную запись к клирингу
	 * @param LongRecord $longRecord
	 * @return $this
	 */
	public function addLongRecord(LongRecord $longRecord){
		$this->longRecord = $longRecord;
		return $this;
	}

}
