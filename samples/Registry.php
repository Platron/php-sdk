<?php

namespace Platron\PhpSdk\samples;

use DateTime;
use Platron\PhpSdk\request\commands\GetRegistry;
use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\clients\Client;

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