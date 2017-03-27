<?php

namespace Platron\PhpSdk\samples;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\DoCaptureBuilder;

class Capture {

	public function actionIndex($transaction, $secretKey, $merchant) {
		$client = new PostClient($merchant, $secretKey);

		try {
			$requestBuilder = new DoCaptureBuilder($transaction);
			$response = $client->request($requestBuilder);
		} catch (Exception $e) {
			var_dump($e);
			die();
		}

		var_dump($response);
	}

}
