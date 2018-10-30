<?php

namespace Platron\PhpSdk\tests\unit;

use Platron\PhpSdk\callback\Callback;

class CallbackTest extends \PHPUnit_Framework_TestCase
{

	/** @var Callback */
	protected $fixture;

	private function setUp()
	{
		$this->fixture = new Callback('test.php', 'adfsvsdfvsd');
	}

	public function testOkAnswear()
	{
		$response = $this->fixture->responseOk(array('pg_salt' => 1111));
		$this->assertEquals($response->pg_status, 'ok');
		$this->assertNotNull($response->pg_sig);
		$this->assertNotNull($response->pg_description);
		$this->assertNotNull($response->pg_salt);
	}

	public function testErrorAnswear()
	{
		$response = $this->fixture->responseError(array('pg_salt' => 1111), 'some_error');
		$this->assertEquals($response->pg_status, 'error');
		$this->assertNotNull($response->pg_sig);
		$this->assertNotNull($response->pg_description);
		$this->assertNotNull($response->pg_salt);
	}

	public function testRejectedAnswear()
	{
		$response = $this->fixture->responseRejected(array('pg_salt' => 1111), 'reject please');
		$this->assertEquals($response->pg_status, 'rejected');
		$this->assertNotNull($response->pg_sig);
		$this->assertNotNull($response->pg_description);
		$this->assertNotNull($response->pg_salt);
	}

	public function testCanReject()
	{
		$this->assertTrue($this->fixture->canReject(array('pg_can_reject' => 1)));
		$this->assertFalse($this->fixture->canReject(array('pg_can_reject' => 0)));
		$this->assertFalse($this->fixture->canReject(array()));
	}
}
