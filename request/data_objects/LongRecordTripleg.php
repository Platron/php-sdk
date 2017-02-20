<?php

namespace platron\request\data_objects;

class LongRecordTripleg extends Data implements iData {
	
	/**
	 * @param int $triplegNumber Номер шага
	 * @param string $date Дата полета
	 * @param string $carrier Перевозчик
	 * @param string $class Класс перевозки
	 * @param string $destFrom Аэропорт вылета
	 * @param string $destTo Аэропорт прилета
	 * @param string $stopOver Можно ли делать остановку
	 * @param string $basisCode Код тарифа
	 * @param string $flightNumber Номер рейса
	 */
	public function __construct($triplegNumber, $date, $carrier, $class, $destFrom, $destTo, $stopOver, $basisCode, $flightNumber) {
		$dateParamName = 'pg_tripleg_'.$triplegNumber.'_date';
		$this->$dateParamName = $date;
		
		$carrierName = 'pg_tripleg_'.$triplegNumber.'_carrier';
		$this->$carrierName = $carrier;
		
		$className = 'pg_tripleg_'.$triplegNumber.'_class';
		$this->$className = $class;
		
		$destFromName = 'pg_tripleg_'.$triplegNumber.'_destination_from';
		$this->$destFromName = $destFrom;
		
		$destToName = 'pg_tripleg_'.$triplegNumber.'_destination_to';
		$this->$destToName = $destTo;
		
		$stopOverName = 'pg_tripleg_'.$triplegNumber.'_stopover';
		$this->$stopOverName = $stopOver;
		
		$basisCodeName = 'pg_tripleg_'.$triplegNumber.'_fare_basis_code';
		$this->$basisCodeName = $basisCode;
		
		$flightNumberName = 'pg_tripleg_'.$triplegNumber.'_flight_number';
		$this->$flightNumberName = $flightNumber;
	}
}
