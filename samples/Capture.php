<?php

namespace Platron\PhpSdk\samples;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\clients\Client;
use Platron\PhpSdk\request\request_builders\DoCaptureBuilder;

class Capture {

	public function actionIndex($transaction, $secretKey, $merchant) {
		$client = new Client($merchant, $secretKey);

		try {
			$command = new DoCaptureBuilder($transaction);
			$response = $command->execute($client);
		} catch (Exception $e) {
			var_dump($e);
			die();
		}

		var_dump($response);
	}

}
