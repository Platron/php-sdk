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
			$requestBuilder = $this->generateMock($url, $parameters);
			$this->fixture->request($requestBuilder);
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
	
	/**
	 * 
	 * @param string $url
	 * @param array $params
	 * @return Platron\PhpSdk\request\request_builders\RequestBuilder
	 */
	protected function generateMock($url, $params){
		$stubRequestBuilder = $this->getMockBuilder('Platron\PhpSdk\request\request_builders\RequestBuilder')->disableOriginalConstructor()->setMethods(array('getParameters','getRequestUrl'))->getMock();
		$stubRequestBuilder->expects($this->any())->method('getParameters')->willReturn($params);
		$stubRequestBuilder->expects($this->any())->method('getRequestUrl')->willReturn($url);
		return $stubRequestBuilder;
	}
}
