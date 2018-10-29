<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для получения реестра платежей
 */
class GetRegistryBuilder extends RequestBuilder
{

	/** @var string */
	private $pg_date;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl()
	{
		return self::PLATRON_URL . 'get_registry.php';
	}

	/**
	 * @param \DateTime $dateTime
	 */
	public function __construct(\DateTime $dateTime)
	{
		$this->pg_date = $dateTime->format('Y-m-d');
	}

}
