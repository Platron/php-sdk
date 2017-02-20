<?php

namespace platron\request\commands;

/**
 * Команда для получения реестра платежей
 */
class GetRegistry extends Command implements iCommand {
	
	/** @var string */
	protected $pg_date;
	
	public function __construct(\DateTime $dateTime) {
		$this->pg_date = $dateTime->format('Y-m-d');
	}

	public function getRequestUrl() {
		return self::PLATRON_URL . 'get_registry.php';
	}
}
