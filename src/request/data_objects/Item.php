<?php

namespace Platron\PhpSdk\request\data_objects;

class Item extends BaseData {
	
	const 
		VAT0 = '0', // 0%
		VAT10 = '10', // 10%
		VAT18 = '18', // 18%
		VAT110 = '110', // формула 10/110
		VAT118 = '118'; // формула 18/118
	
	/** @var string */
	protected $pg_label;
	/** @var float */
	protected $pg_amount;
	/** @var float */
	protected $pg_price;
	/** @var int */
	protected $pg_quantity;
	/** @var string */
	protected $pg_vat;
	/** @var string */
	protected $pg_type = 'product';
	
	/**
	 * @param string $label Название товара
	 * @param float $price Цена единицы товара
	 * @param int $quantity Количество
	 * @param string $vat Если отсутствует - не облягается налогом. Берется из констант
	 * @throws \Platron\PhpSdk\Exception
	 */
	public function __construct($label, $price, $quantity, $vat = null) {
		if(!is_null($vat) && !in_array($vat, $this->getVatTypes())){
			throw new \Platron\PhpSdk\Exception('Wrong vat. Use from constant');
		}
		
		$this->pg_label = $label;
		$this->pg_quantity = $quantity;
		$this->pg_price = $price;
		$this->pg_vat = $vat;
	}
	
	/**
	 * Добавить сумму к позиции. Не обязательно. Если сумма меньше количества * стоимость воспринимается как скидка
	 * @param float $amount
	 */
	public function addAmount($amount){
		$this->pg_amount = $amount;
	}

	/**
	 * Добавить тип товара
	 * @param string $type
	 */
	public function addType($type){
		$this->pg_type = $type;
	}
	
	/**
	 * Получить возможные варианты НДС
	 * @return array
	 */
	protected function getVatTypes(){
		return array(
			self::VAT0,
			self::VAT10,
			self::VAT110,
			self::VAT118,
			self::VAT18,
		);
	}
}
