<?php

namespace Platron\PhpSdk\request\request_builders;

/**
 * Строитель для получения информации по бину. Для работы с этим запросом необходимо согласование с менеджером
 */
class GetBinInfoBuilder extends RequestBuilder {

	/** @var int Бин карты */
	protected $pg_bin;

	/**
	 * @inheritdoc
	 */
	public function getRequestUrl() {
		return self::PLATRON_URL . 'get_bin_info.php';
	}

	/**
	 * @param int $bin Бин карты
	 */
	public function __construct($bin) {
		$this->pg_bin = $bin;
	}

}
