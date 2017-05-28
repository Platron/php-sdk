<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\data_objects\Item;

class ReceiptBuilder extends RequestBuilder {
	
	const 
		TRANSACTION_TYPE = 'transaction',
		REFUND_TYPE = 'refund',
		MONEYBACK_TYPE = 'moneyback';
	
	/** @var string */
	protected $pg_operation_type;
	/** @var int */
	protected $pg_payment_id;
	/** @var string */
	protected $pg_order_id;
	/** @var Item[] */
	protected $items;
	
	/**
	 * @inheritdoc
	 */
	public function getRequestUrl() {
		return self::PLATRON_URL.'receipt.php';
	}
	
	/**
	 * Обязательно одно из двух полей - $paymentId или $orderId
	 * @param string $operationType Чек к какому типу операции. Из констант
	 * @param int $paymentId 
	 * @param string $orderId
	 */
	public function __construct($operationType, $paymentId = null, $orderId = null) {
		if(!in_array($operationType, $this->getPossibleOperationTypes())){
			throw new Exception('Wrong operation type. Use constants');
		}
		
		$this->pg_operation_type = $operationType;
		$this->pg_payment_id = $paymentId;
		$this->pg_order_id = $orderId;
	}
	
	/**
	 * Получить возможные варианты операций
	 * @return array
	 */
	protected function getPossibleOperationTypes(){
		return array(
			self::TRANSACTION_TYPE,
			self::REFUND_TYPE,
			self::MONEYBACK_TYPE,
		);
	}
	
	/**
	 * Добавить позицию чека
	 * @param Item $item
	 * @return self
	 */
	public function addItem(Item $item){
		$this->items[] = $item;
		return self;
	}
	
	/**
	 * @inheritdoc
	 */
	public function getParameters() {
		$filledvars = array();
		foreach (get_object_vars($this) as $name => $value) {
			if ($value && !in_array($name, array('items'))) {
				$filledvars[$name] = (string)$value;
			}
		}

		foreach($this->items as $item){
			$filledvars['pg_items'][] = $item->getParameters();
		}
		
		return $filledvars;
	}
}
