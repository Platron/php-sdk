<?php

namespace Platron\PhpSdk\samples;

use Platron\PhpSdk\Exception;
use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;

class CreateTransaction {
		
	public function actionIndex($merchant, $secretKey){
		$client = new PostClient($merchant, $secretKey);
		try {
			$requestBuilder = new InitPaymentBuilder('10.00', 'Test transaction');
			$requestBuilder->addTestingMode()
				->addUserEmail('test@test.ru')
				->addUserPhone('79055770000')
				->addPaymentSystem('TEST');
			
			$response = $client->request($requestBuilder);
		}
		catch (Exception $e){
			var_dump($e);
			die();
		}
		
		var_dump($response);
	}
}
