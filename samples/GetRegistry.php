<?php

namespace platron_sdk\samples;

require_once '../autoload.php';

use DateTime;
use platron_sdk\request\commands\GetRegistry;
use platron_sdk\Exception;
use platron_sdk\request\clients\Client;

class Registry {

	public function actionIndex($merchant, $secretKey) {
		$client = new Client($merchant, $secretKey);
		try {
			$command = new GetRegistry(new DateTime('now - 1 day'));
			$response = $command->execute($client);
		} catch (Exception $e) {
			var_dump($e);
			die();
		}

		var_dump($response);
	}

}