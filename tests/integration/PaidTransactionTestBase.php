<?php

namespace Platron\PhpSdk\tests\integration;


use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\request\request_builders\GetStatusBuilder;

abstract class PaidTransactionTestBase extends IntegrationTestBase
{
    /** @var GetStatusBuilder */
    protected $getStatusBuilder;

    /** @var PostClient */
    protected $postClient;

    const ITERATION_COUNT = 5;
    const WAITING_TIME = 2;

    /*
     * @return InitPaymentBuilder
     */
    abstract protected function getInitPaymentBuilder();

    public function setUp() {
        parent::setUp();

        $postClient = new PostClient($this->merchantId, $this->secretKey);
        $this->postClient = $postClient;

        $initPaymentBuilder = $this->getInitPaymentBuilder();
        $this->paymentId = (int)$postClient->request($initPaymentBuilder)->pg_payment_id;

        $this->getStatusBuilder = new GetStatusBuilder($this->paymentId);
        $this->waitForTransaction();
    }

    /*
     * Ожидание успешного завершения платежа
     */
    public function waitForTransaction() {
        for ($i = 0; $i < static::ITERATION_COUNT; $i++) {
            $response = $this->postClient->request($this->getStatusBuilder);
            $status = $response->pg_transaction_status;
            if ($status == 'ok') {
                break;
            }
            sleep(static::WAITING_TIME);
        }
    }
}