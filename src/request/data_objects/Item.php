<?php

namespace Platron\PhpSdk\request\data_objects;

use Platron\PhpSdk\Exception;

class Item extends BaseData
{
	const
		TYPE_PRODUCT = 'product',
		TYPE_PRODUCT_EXCISE = 'product_excise',
		TYPE_WORK = 'work',
		TYPE_SERVICE = 'service',
		TYPE_GAMBLING_BET = 'gambling_bet',
		TYPE_GAMBLING_WIN = 'gambling_win',
		TYPE_LOTTERY_BET = 'lottery_bet',
		TYPE_LOTTERY_WIN = 'lottery_win',
		TYPE_RID = 'rid',
		TYPE_PAYMENT = 'payment',
		TYPE_COMMISSION = 'commission',
		TYPE_COMPOSITE = 'composite',
		TYPE_OTHER = 'other';

	const
		VAT0 = '0', // 0%
		VAT10 = '10', // 10%
		VAT20 = '20', // 20%
		VAT110 = '110', // формула 10/110
		VAT120 = '120'; // формула 20/120

	const
		PAYMENT_FULL_PAYMENT = 'full_payment',
		PAYMENT_PRE_PAYMENT_FULL = 'pre_payment_full',
		PAYMENT_PRE_PAYMENT_PART = 'pre_payment_part',
		PAYMENT_ADVANCE = 'advance',
		PAYMENT_CREDIT_PART = 'credit_part',
		PAYMENT_CREDIT_PAY = 'credit_pay',
		PAYMENT_CREDIT = 'credit';

	const
		AGENT_TYPE_COMMISSIONAIRE = 'commissionaire';

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
	/** @var string */
	protected $pg_payment_type;

	/** @var string */
	protected $pg_agent_type;
	/** @var string */
	protected $pg_agent_name;
	/** @var int */
	protected $pg_agent_inn;
	/** @var int */
	protected $pg_agent_phone;

	/**
	 * @param string $label Название товара
	 * @param float $price Цена единицы товара
	 * @param int $quantity Количество
	 * @param string $vat Если отсутствует - не облягается налогом. Берется из констант
	 * @throws \Platron\PhpSdk\Exception
	 */
	public function __construct($label, $price, $quantity, $vat = null)
	{
		if (!is_null($vat) && !in_array($vat, $this->getVatTypes())) {
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
	public function addAmount($amount)
	{
		$this->pg_amount = $amount;
	}

	/**
	 * Добавить тип товара
	 * @param string $type
	 * @throws Exception
	 */
	public function addType($type)
	{
		if (!in_array($type, $this->getTypes())) {
			throw new \Platron\PhpSdk\Exception('Wrong type. Use type from constant');
		}

		$this->pg_type = $type;
	}

	/**
	 * Добавить тип товара
	 * @param string $type
	 * @throws Exception
	 */
	public function addPaymentType($type)
	{
		if (!in_array($type, $this->getPaymentTypes())) {
			throw new \Platron\PhpSdk\Exception('Wrong payment type. Use payment type from constant');
		}

		$this->pg_payment_type = $type;
	}

	/**
	 * @param string $type
	 * @param string $name
	 * @param int $inn
	 * @param int $phone
	 * @throws Exception
	 */
	public function addAgent($type, $name, $inn, $phone)
	{
		if (!in_array($type, $this->getAgentTypes())) {
			throw new \Platron\PhpSdk\Exception('Wrong agent type. Use agent type from constant');
		}

		$this->pg_agent_type = $type;
		$this->pg_agent_name = $name;
		$this->pg_agent_inn = $inn;
		$this->pg_agent_phone = $phone;
	}

	/**
	 * Получить возможные варианты НДС
	 * @return array
	 */
	private function getVatTypes()
	{
		return array(
			self::VAT0,
			self::VAT10,
			self::VAT110,
			self::VAT120,
			self::VAT20,
		);
	}

	/**
	 * @return array
	 */
	private function getTypes(){
		return array(
			self::TYPE_PRODUCT,
			self::TYPE_PRODUCT_EXCISE,
			self::TYPE_WORK,
			self::TYPE_SERVICE,
			self::TYPE_GAMBLING_BET,
			self::TYPE_GAMBLING_WIN,
			self::TYPE_LOTTERY_BET,
			self::TYPE_LOTTERY_WIN,
			self::TYPE_RID,
			self::TYPE_PAYMENT,
			self::TYPE_COMMISSION,
			self::TYPE_COMPOSITE,
			self::TYPE_OTHER
		);
	}

	/**
	 * @return array
	 */
	private function getPaymentTypes()
	{
		return array(
			self::PAYMENT_FULL_PAYMENT,
			self::PAYMENT_PRE_PAYMENT_FULL,
			self::PAYMENT_PRE_PAYMENT_PART,
			self::PAYMENT_ADVANCE,
			self::PAYMENT_CREDIT_PART,
			self::PAYMENT_CREDIT_PAY,
			self::PAYMENT_CREDIT,
		);
	}

	/**
	 * @return array
	 */
	private function getAgentTypes()
	{
		return array(
			self::AGENT_TYPE_COMMISSIONAIRE,
		);
	}
}
