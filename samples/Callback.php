<?php

namespace platron_sdk\samples;

use Exception;
use platron_sdk\callback\Callback;

class Callback {

	public function actionIndex($request, $secretKey) {
		$callback = new Callback($secretKey);
		if ($callback->validateSig($request)) {
			try {
				if ($this->checkOrderAvailiable()) {
					echo $callback->responseOk($request);
				} elseif ($callback->canReject($request)) {
					echo $callback->responseRejected($request, 'Заказ недоступен');
				} else {
					echo $callback->responseOk($request);
					/*
					 * Вернуть транзакцию через манибек систему или через заявку на возврат
					 */
				}
			} catch (Exception $e) {
				echo $callback->responseError($request, 'Невозможно принять запрос. Повторите еще раз');
			}
		}
	}

	public function checkOrderAvailiable() {
		return true;
	}

}
