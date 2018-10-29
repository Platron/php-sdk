<?php

namespace Platron\PhpSdk\tests\integration;

abstract class IntegrationTestBase extends \PHPUnit_Framework_TestCase
{
	/** @var int */
	private $merchantId;
	/** @var string */
	private $secretKey;

	public function setUp()
	{
		$this->merchantId = MerchantSettings::MERCHANT_ID;
		$this->secretKey = MerchantSettings::SECRET_KEY;
	}
}
