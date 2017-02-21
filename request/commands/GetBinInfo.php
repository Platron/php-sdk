<?php

namespace platron_sdk\request\commands;

/**
 * Команда для получения информации по бину. Для работы с этим запросом необходимо согласование с менеджером
 */
class GetBinInfo extends Command implements iCommand {
	
	/** @var int Бин карты */
	protected $pg_bin;
	
	/**
	 * @param int $bin Бин карты
	 * @return $this
	 */
	public function __construct($bin) {
		$this->pg_bin = $bin;
		return $this;
	}
	
	public function getRequestUrl() {
		return self::PLATRON_URL . 'get_bin_info.php';
	}

}
