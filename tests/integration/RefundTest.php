<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\data_objects\BankCard;
use Platron\PhpSdk\request\request_builders\DoCaptureBuilder;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\RevokeBuilder;

class RefundTest extends PaidTransactionTestBase
{
    /** @var int */
    protected $paymentId;

    public function getInitPaymentBuilder()
    {
        $factory = new InitPaymentBuilderFactory();
        return $factory->createForTestCardPaymentSystem();
    }

    public function testRefund(){
        $doCaptureBuilder = new DoCaptureBuilder($this->paymentId);
        $this->postClient->request($doCaptureBuilder);

        $refundBuilder = new RevokeBuilder($this->paymentId);
        $refundBuilder->setAmount(5.00);

        $RefundResponse = $this->postClient->request($refundBuilder);
        $this->assertEquals('ok', $RefundResponse->pg_status);
    }

    public function testRevoke()
    {
        $revokeBuilder = new RevokeBuilder($this->paymentId);
        $this->assertEquals('ok', $this->postClient->request($revokeBuilder)->pg_status);
    }
}