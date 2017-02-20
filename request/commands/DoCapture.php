<?php

namespace platron_sdk\request\commands;

use platron\request\data_objects\LongRecord;

/**
 * Команда для проведения клиринга по транзакции
 */
class DoCapture extends Command implements iCommand {
	/** @var int Id платежа */
	protected $pg_payment_id;
	/** @var LongRecord Длинная запись */
	protected $longRecord;
	
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
	public function addLongRecord(LongRecord $longRecord){
		$this->longRecord = $longRecord;
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'do_capture.php';
	}
	
	public function getParameters() {
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

}
