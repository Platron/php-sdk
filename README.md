Platron PHP SDK
===============
## Установка

Проект предполагает через установку с использованием composer. 

<pre><code>composer require Platron\php_sdk
composer install</pre></code>

Если проект устанавливался без composer - есть возможность подключить в свой автолоадер файл **autoload.php** в корне проекта

## Тесты
Для работы тестов необходим PHPUnit, для установки необходимо выполнить команду
```
composer install
```
Запустить тесты можно выполнив команду
```
vendor/bin/phpunit
```

## Примеры использования

### 1. Создание транзакции

<pre><code>
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
</pre></code>

### 2. Запрос реестра

<pre><code>
$client = new Platron\PhpSdk\request\clients\PostClient('82', 'sdvsfdvsfdvsdv');
try {
    $requestBuilder = new Platron\PhpSdk\request\request_builders\GetRegistryBuilder(new DateTime('now - 1 day'));
    $response = $client->request($requestBuilder);
} catch (Platron\PhpSdk\Exception $e) {
    var_dump($e);
    die();
}
</pre></code>

### 3. Проведение клиринга 

<pre><code>
$client = new Platron\PhpSdk\request\clients\PostClient('82', 'sdvsfdvsfdvsdv');
try {
    $requestBuilder = new Platron\PhpSdk\request\request_builders\DoCaptureBuilder($transaction);
    $response = $client->request($requestBuilder);
} catch (Exception $e) {
    var_dump($e);
    die();
}
</pre></code>

### 4. Обработка запроса от Platron

<pre><code>

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
</pre></code>

$order_available - вместо переменной долже быть метод, проверящий - доступен ли для оплаты заказ