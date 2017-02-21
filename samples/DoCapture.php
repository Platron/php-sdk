<?php

namespace platron_sdk\samples;

require_once '../autoload.php';

use platron_sdk\request\commands\DoCapture;
use platron_sdk\Exception;
use platron_sdk\request\Requester;

class Capture {
	public function actionIndex($transaction, $secretKey, $merchant){
		$requester = new Requester($merchant, $secretKey);
		$command = new DoCapture($transaction);
		try {
			$requester->request($command);
		}
		catch (Exception $e){
			var_dump($e);
			die();
		}
		
		var_dump($response);
	}
}
