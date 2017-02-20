<?php

namespace platron_sdk\samples;

require_once '../autoload.php';

use DateTime;
use platron_sdk\request\commands\GetRegistry;
use platron_sdk\request\Exception;
use platron_sdk\request\Requester;

class Registry {
	public function actionIndex($merchant, $secretKey){
		$requester = new Requester($merchant, $secretKey);
		$command = new GetRegistry(new DateTime('now - 1 day'));
		try {
			$response = $requester->request($command);
		}
		catch (Exception $e){
			var_dump($e);
			die();
		}
		
		var_dump($response);
	}
}