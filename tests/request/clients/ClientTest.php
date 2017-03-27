<?php

namespace Platron\PhpSdk\tests;

use Platron\PhpSdk\request\clients\PostClient;
use Platron\PhpSdk\Exception;

class ClientTest extends \PHPUnit_Framework_TestCase {
	
	/** @var PostClient */
	protected $fixture;
	
	public function setUp() {
		$this->fixture = new PostClient('82', 'sdfvdfvfsdvfsd');
	}
	
	/**
	 * @dataProvider provider
	 * @param string $url
	 * @param array $parameters
	 */
	public function testRequest($url, $parameters){
		try {		
			$this->fixture->request($url, $parameters);
		}
		catch (Exception $e){
			return true;
		}
		
		return false;
	}
	
	public function provider(){
		return array(
			array('www.not-found-site.sdcasdasdcasdc', array(1,2,3)),
			array('www.platron.ru/init_payment.php', array(1,2,3)),
			array('www.google.com', array()),
		);
	}
}
