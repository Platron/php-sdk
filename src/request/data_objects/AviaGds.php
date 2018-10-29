<?php

namespace Platron\PhpSdk\request\data_objects;

class AviaGds extends BaseData
{
	/** @var string[] Список брендов карт, принимаемых к оплате */
	private $pg_card_brand;
	/** @var string PNR */
	private $pg_rec_log;
	/** @var string Название GDS (AMADUS|SABRE|GALILEO и т.д.) */
	private $pg_gds;
	/** @var float Сумма надбавки магазина */
	private $pg_merchant_markup;

	/**
	 * @param string $recLoc PNR
	 * @param string $gds Название GDS (AMADUS|SABRE|GALILEO и т.д.)
	 * @param float $markup Сумма надбавки магазина
	 */
	public function __construct($recLoc, $gds, $markup)
	{
		$this->pg_rec_log = $recLoc;
		$this->pg_gds = $gds;
		$this->pg_merchant_markup = $markup;
	}

	/**
	 * Установить тип карт, по которым принимаем оплату
	 * @param array $cardBrands
	 */
	public function addCardBrands($cardBrands)
	{
		$this->pg_card_brand = $cardBrands;
	}

}
