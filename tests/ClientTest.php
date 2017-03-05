<?php

namespace platron_sdk\tests;

use platron_sdk\request\clients\Client;
use platron_sdk\Exception;

class ClientTest extends \PHPUnit_Framework_TestCase {
	
	/** @var Client */
	protected $fixture;
	
	public function setUp() {
		$this->fixture = new Client('82', 'sdfvdfvfsdvfsd');
	}
	
	/**
	 * @dataProvider provider
	 * @expectedException Exception
	 * @param string $url
	 * @param array $parameters
	 */
	public function testRequest($url, $parameters){
		$exception = new Exception();
		$this->expectException($exception);
		
		$this->fixture->request($url, $parameters);
	}
	
	public function provider(){
		return array(
			array('www.not-found-site.sdcasdasdcasdc', array(1,2,3)),
			array('www.platron.ru/init_payment.php', array(1,2,3)),
			array('www.google.com', array()),
		);
	}
}
