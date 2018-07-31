<?php

namespace Platron\PhpSdk\tests\integration;

use Platron\PhpSdk\request\data_objects\BankCard;
use Platron\PhpSdk\request\request_builders\DoCaptureBuilder;
use Platron\PhpSdk\request\request_builders\InitPaymentBuilder;
use Platron\PhpSdk\request\request_builders\RevokeBuilder;

class RefoundTest extends PayedTransactionTestBase
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

    public function testRefound(){
        $this->waitForTransaction();

        // Клиринг
        $doCaptureBuilder = new DoCaptureBuilder($this->paymentId);
        $this->postClient->request($doCaptureBuilder);

        $refoundBuilder = new RevokeBuilder($this->paymentId);
        $refoundBuilder->setAmount(5.00);

        $RefoundResponse = $this->postClient->request($refoundBuilder);
        $this->assertEquals('ok', $RefoundResponse->pg_status);
    }
}