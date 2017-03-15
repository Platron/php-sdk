<?php

namespace Platron\PhpSdk\request\commands;

/**
 * Команда для получения информации по бину. Для работы с этим запросом необходимо согласование с менеджером
 */
class GetBinInfo extends BaseCommand {

	/** @var int Бин карты */
	protected $pg_bin;

	/**
	 * @inheritdoc
	 */
	protected function getRequestUrl() {
		return self::PLATRON_URL . 'get_bin_info.php';
	}

	/**
	 * @param int $bin Бин карты
	 */
	public function __construct($bin) {
		$this->pg_bin = $bin;
	}

}
