<?php

namespace platron_sdk\samples;

require_once '../autoload.php';

use platron_sdk\Exception;
use platron_sdk\request\clients\Client;
use platron_sdk\request\commands\InitPayment;

class CreateTransaction {
		
	public function actionIndex($merchant, $secretKey){
		$client = new Client($merchant, $secretKey);
		try {
			$command = new InitPayment('10.00', 'Test transaction');
			$response = $command
				->addTestingMode()
				->addUserEmail('test@test.ru')
				->addUserPhone('79055770000')
				->addPaymentSystem('TEST')
				->execute($client);
		}
		catch (Exception $e){
			var_dump($e);
			die();
		}
		
		var_dump($response);
	}
}
