<?php

namespace platron_sdk\tests;

require_once '../autoload.php';

use \platron_sdk\callback\Callback;

class CallbackTest extends \PHPUnit_Framework_TestCase {
	
	/** @var Callback */
	protected $fixture;
	
	protected function setUp() {
		$stub = $this->getMock('platron_sdk\SigHelper')->expects($this->once())->method('check')->will($this->returnValue(true));
		$this->fixture = new Callback('test.php', $stub);
	}
	
	public function testOkAnswear(){
		$response = $this->fixture->responseOk(array('pg_salt' => 1111));
		$this->assertEquals($response->pg_status, 'ok');
		$this->assertNotNull($response->pg_sig);
		$this->assertNotNull($response->pg_description);
		$this->assertNotNull($response->pg_salt);
	}
	
	public function testErrorAnswear(){
		$response = $this->fixture->responseError(array('pg_salt' => 1111), 'some_error');
		$this->assertEquals($response, 'error');
		$this->assertEquals($response->pg_status, 'ok');
		$this->assertNotNull($response->pg_sig);
		$this->assertNotNull($response->pg_description);
		$this->assertNotNull($response->pg_salt);
	}
	
	public function testRejectedAnswear(){
		$response = $this->fixture->responseRejected(array('pg_salt' => 1111), 'reject please');
		$this->assertEquals($response, 'rejected');
		$this->assertEquals($response->pg_status, 'ok');
		$this->assertNotNull($response->pg_sig);
		$this->assertNotNull($response->pg_description);
		$this->assertNotNull($response->pg_salt);
	}
	
	public function testCanReject(){
		$this->assertTrue($this->fixture->canReject(array('pg_can_reject' => 1)));
		$this->assertFalse($this->fixture->canReject(array('pg_can_reject' => 0)));
		$this->assertFalse($this->fixture->canReject(array()));
	}
	
	public function testValidateSig(){
		$this->assertTrue($this->fixture->validateSig(array('pg_sig' => 'hjbhjbhjjhbd')));
	}
}
