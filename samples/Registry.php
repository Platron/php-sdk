<?php

namespace Platron\PhpSdk\samples;

use DateTime;
use Platron\PhpSdk\request\request_builders\GetRegistryBuilder;
use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\clients\PostClient;

class Registry {

	public function actionIndex($merchant, $secretKey) {
		$client = new PostClient($merchant, $secretKey);
		try {
			$requestBuilder = new GetRegistryBuilder(new DateTime('now - 1 day'));
			$response = $client->request($requestBuilder);
		} catch (Exception $e) {
			var_dump($e);
			die();
		}

		var_dump($response);
	}

}