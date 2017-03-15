<?php

namespace platron_sdk\request\data_objects;

use platron_sdk\Exception;

class LongRecord extends BaseData {
	
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
	public $triplegs = array();
	
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
	 * @return $this
	 */
	public function setTicketSystem($ticketSystem){
		$this->pg_ticket_system = $ticketSystem;
		return $this;
	}
	
	/**
	 * Установить код агента
	 * @param string $ticketAgencyCode
	 * @return $this
	 */
	public function setAgencyCode($ticketAgencyCode){
		$this->pg_ticket_agency_code = $ticketAgencyCode;
		return $this;
	}
	
	/**
	 * Добавить шаг в билет. Возможно добавить только 4 шага
	 * @param LongRecordTripleg $tripLeg
	 * @return $this
	 */
	public function addTripLeg(LongRecordTripleg $tripLeg){
		if(count($this->triplegs) > 3){
			throw new Exception('Доступно создание только 4 шагов');
		}
			
		$this->triplegs[] = $tripLeg;
		return $this;
	}
	
	public function getParameters() {
		$parameters = array();
		foreach(get_object_vars($this) as $name => $value){
			if($value && !in_array($name, array('triplegs'))){
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
