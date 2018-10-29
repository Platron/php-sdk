<?php

namespace Platron\PhpSdk\request\request_builders;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\data_objects\Item;

class ReceiptBuilder extends RequestBuilder
{
	const
		ADDITIONAL_PAYMENT_PREPAYMENT = 'prepayment',
		ADDITIONAL_PAYMENT_CREDIT = 'credit';

	const
		TRANSACTION_TYPE = 'payment',
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
	/** @var double */
	protected $pg_additional_payment_amount;
	/** @var string */
	protected $pg_additional_payment_type;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'receipt.php';
	}

	/**
	 * Обязательно одно из двух полей - $paymentId или $orderId
	 * @param string $operationType Чек к какому типу операции. Из констант
	 * @param int $paymentId
	 * @param string $orderId
	 * @throws Exception
	 */
	public function __construct($operationType, $paymentId = null, $orderId = null)
	{
		if (!in_array($operationType, $this->getPossibleOperationTypes())) {
			throw new Exception('Wrong operation type. Use constants');
		}

		if (!$paymentId && !$orderId) {
			throw new Exception('payment id or order id must be not null');
		}

		$this->pg_operation_type = $operationType;
		$this->pg_payment_id = $paymentId;
		$this->pg_order_id = $orderId;
	}

	/**
	 * Получить возможные варианты операций
	 * @return array
	 */
	protected function getPossibleOperationTypes()
	{
		return array(
			self::TRANSACTION_TYPE,
			self::REFUND_TYPE,
			self::MONEYBACK_TYPE,
		);
	}

	/**
	 * Добавить позицию чека
	 * @param Item $item
	 * @return $this
	 */
	public function addItem(Item $item)
	{
		$this->items[] = $item;
		return $this;
	}

	public function addAdditionalPayment($type, $amount)
	{
		if (!in_array($type, $this->getAdditionalPaymentTypes())) {
			throw new Exception('Wrong additional payment type. Use from constant');
		}

		$this->pg_additional_payment_type = $type;
		$this->pg_additional_payment_amount = $amount;
	}

	/**
	 * @inheritdoc
	 */
	public function getParameters()
	{
		$filledvars = array();
		foreach (get_object_vars($this) as $name => $value) {
			if ($value !== null && !in_array($name, array('items'))) {
				$filledvars[$name] = (string)$value;
			}
		}

		foreach ($this->items as $item) {
			$filledvars['pg_items'][] = $item->getParameters();
		}

		return $filledvars;
	}

	/**
	 * Получить возможные типы дополнительных оплат не через Платрон
	 * @return array
	 */
	private function getAdditionalPaymentTypes()
	{
		return array(
			self::ADDITIONAL_PAYMENT_PREPAYMENT,
			self::ADDITIONAL_PAYMENT_CREDIT,
		);
	}
}
