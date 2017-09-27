Platron PHP SDK
===============
## Установка

Проект предполагает через установку с использованием composer. 
<pre><code>composer require payprocessing/phpsdk</pre></code>

## Тесты
Для работы тестов необходим PHPUnit, для установки необходимо выполнить команду
```
composer install
```
Запустить unit тесты можно выполнив команду из корня проекта
```
vendor/bin/phpunit tests/unit
```
Для того, чтобы запустить интеграционные тесты нужно скопировать файл tests/integration/MerchantSettingsSample.php удалив 
из названия Sample и вставив настройки магазина. После выполнить команду из корня проекта
```
vendor/bin/phpunit tests/integration
```

## Примеры использования

### 1. Создание транзакции

```php
$client = new Platron\PhpSdk\request\clients\PostClient('82', 'sdvsfdvsfdvsdv');
try {
    $requestBuilder = new Platron\PhpSdk\request\request_builders\InitPaymentBuilder('10.00', 'Test transaction');
    $requestBuilder->addTestingMode()
        ->addUserEmail('test@test.ru')
        ->addUserPhone('79055770000')
        ->addPaymentSystem('TEST');
    $response = $client->request($requestBuilder);
}
catch (Platron\PhpSdk\Exception\Exception $e){
    var_dump($e);
    die();
}
```

### 2. Запрос реестра

```php
$client = new Platron\PhpSdk\request\clients\PostClient('82', 'sdvsfdvsfdvsdv');
try {
    $requestBuilder = new Platron\PhpSdk\request\request_builders\GetRegistryBuilder(new DateTime('now - 1 day'));
    $response = $client->request($requestBuilder);
} catch (Platron\PhpSdk\Exception $e) {
    var_dump($e);
    die();
}
```

### 3. Проведение клиринга 

```php
$client = new Platron\PhpSdk\request\clients\PostClient('82', 'sdvsfdvsfdvsdv');
try {
    $requestBuilder = new Platron\PhpSdk\request\request_builders\DoCaptureBuilder($transaction);
    $response = $client->request($requestBuilder);
} catch (Exception $e) {
    var_dump($e);
    die();
}
```

### 4. Обработка запроса от Platron (check)

```php
$order_available = 1;
$callback = new platron_sdk\callback\Callback('platron_dispatch.php', 'sdvsfdvsfdvsdv');
if ($callback->validateSig($request)) {
    try {
        if ($order_available) {
            echo $callback->responseOk($request);
        } elseif ($callback->canReject($request)) {
            echo $callback->responseRejected($request, 'Заказ недоступен');
        } else {
            echo $callback->responseOk($request);
            /*
             * Вернуть транзакцию через манибек систему или через заявку на возврат
             */
        }
    } catch (Platron\PhpSdk\samples $e) {
        echo $callback->responseError($request, 'Невозможно принять запрос. Повторите еще раз');
    }
}
```

$order_available - вместо переменной долже быть метод, проверящий - доступен ли для оплаты заказ
