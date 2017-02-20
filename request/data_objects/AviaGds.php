<?php

namespace platron_sdk\request\data_objects;

class AviaGds extends Data implements iData {
	/** @var string[] Список брендов карт, принимаемых к оплате */
	protected $pg_card_brand;
	/** @var string PNR */
	protected $pg_rec_log;
	/** @var string Название GDS (AMADUS|SABRE|GALILEO и т.д.) */
	protected $pg_gds;
	/** @var float Сумма надбавки магазина */
	protected $pg_merchant_markup;
	
	/**
	 * @param type $recLoc PNR
	 * @param type $gds Название GDS (AMADUS|SABRE|GALILEO и т.д.)
	 * @param type $markup Сумма надбавки магазина
	 */
	public function __construct($recLoc, $gds, $markup) {
		$this->pg_rec_log = $recLoc;
		$this->pg_gds = $gds;
		$this->pg_merchant_markup = $markup;
	}
	
	/**
	 * Установить тип карт, по которым принимаем оплату
	 * @param array $cardBrands
	 */
	public function addCardBrands($cardBrands){
		$this->pg_card_brand = $cardBrands;
	}

}
