<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для получения статуса чека
 */
class GetReceiptStatusBuilder extends RequestBuilder
{
	/** @var int */
	protected $pg_receipt_id;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'get_receipt_status.php';
	}

	/**
	 * @param int $receiptId
	 */
	public function __construct($receiptId)
	{
		$this->pg_receipt_id = $receiptId;
	}
}