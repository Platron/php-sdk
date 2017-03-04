<?php

namespace platron_sdk\samples;

require_once '../autoload.php';

use platron_sdk\Exception;
use platron_sdk\request\clients\Client;
use platron_sdk\request\commands\DoCapture;
use platron_sdk\SigHelper;

class Capture {

	public function actionIndex($transaction, $secretKey, $merchant) {
		$client = new Client($merchant, new SigHelper($secretKey));

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
