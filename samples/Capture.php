<?php

namespace Platron\PhpSdk\samples;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\clients\Client;
use Platron\PhpSdk\request\commands\DoCapture;

class Capture {

	public function actionIndex($transaction, $secretKey, $merchant) {
		$client = new Client($merchant, $secretKey);

		try {
			$command = new DoCapture($transaction);
			$response = $command->execute($client);
		} catch (Exception $e) {
			var_dump($e);
			die();
		}

		var_dump($response);
	}

}
