<?php

namespace platron\samples;

require_once '../autoload.php';

use platron\request\commands\DoCapture;
use platron\request\Exception;
use platron\request\Requester;

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
