<?php

namespace platron_sdk\tests;

use \platron_sdk\callback\Callback;

class CallbackTest extends \PHPUnit_Framework_TestCase {
	
	/** @var Callback */
	protected $fixture;
	
	protected function setUp() {
		$this->fixture = new Callback();
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
}
