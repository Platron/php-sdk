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

    public function getInitPaymentBuilder(){
        $initPaymentBuilder = new InitPaymentBuilder('10.00', 'test php sdk');
        $initPaymentBuilder->addUserPhone('79009999999')
            ->addTestingMode()
            ->addPaymentSystem('TESTCARD')
            ->addBankCard(
                New BankCard('4257 0000 0000 0002',
                    'TEST',
                    2025,
                    01,
                    '800',
                    '185.76.252.5')
            );
        return $initPaymentBuilder;
    }

    public function testRefund(){
        $this->waitForTransaction();

        // Клиринг
        $doCaptureBuilder = new DoCaptureBuilder($this->paymentId);
        $this->postClient->request($doCaptureBuilder);

        $refundBuilder = new RevokeBuilder($this->paymentId);
        $refundBuilder->setAmount(5.00);

        $RefundResponse = $this->postClient->request($refundBuilder);
        $this->assertEquals('ok', $RefundResponse->pg_status);
    }
}