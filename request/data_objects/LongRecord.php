<?php

namespace platron_sdk\request\data_objects;

use platron_sdk\request\Exception;

class LongRecord extends Data implements iData {
	
	/** @var string Имя пассажира */
	protected $pg_ticket_passenger_name;
	/** @var string Номер билета */
	protected $pg_ticket_number;
	/** @var string Возможна ли остановка */
	protected $pg_ticket_restricted;
	/** @var string Билетная система */
	protected $pg_ticket_system;
	/** @var string Код билетного агента */
	protected $pg_ticket_agency_code;
	
	/** @var LongRecordTripleg[] Список шагов полета */
	public $triplegs = [];
	
	/**
	 * @param string $passangerName
	 * @param string $ticketNumber
	 * @param bool $ticketRestricked
	 */
	public function __construct($passangerName, $ticketNumber, $ticketRestricked) {
		$this->pg_ticket_passenger_name = $passangerName;
		$this->pg_ticket_number = $ticketNumber;
		$this->pg_ticket_restricted = $ticketRestricked;
	}
	
	/**
	 * Установить билетную систему
	 * @param string $ticketSystem
	 */
	public function setTicketSystem($ticketSystem){
		$this->pg_ticket_system = $ticketSystem;
	}
	
	/**
	 * Установить код агента
	 * @param string $ticketAgencyCode
	 */
	public function setAgencyCode($ticketAgencyCode){
		$this->pg_ticket_agency_code = $ticketAgencyCode;
	}
	
	/**
	 * Добавить шаг в билет. Возможно добавить только 4 шага
	 * @param LongRecordTripleg $tripLeg
	 */
	public function addTripLeg(LongRecordTripleg $tripLeg){
		if(count($this->triplegs) > 3){
			throw new Exception('Доступно создание только 4 шагов');
		}
			
		$this->triplegs[] = $tripLeg;
	}
	
	public function getParameters() {
		$parameters = [];
		foreach(get_object_vars($this) as $name => $value){
			if($value && !in_array($name, ['triplegs'])){
				$parameters[$name] = $value;
			}
		}
		
		foreach($this->triplegs as $tripLeg){
			foreach($tripLeg->getParameters() as $name => $value){
				if($value){
					$parameters[$name] = $value;
				}
			}
		}
		
		return $parameters;
	}
}
