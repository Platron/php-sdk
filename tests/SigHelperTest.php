<?php

namespace platron_sdk\tests;

require_once '../autoload.php';

use platron_sdk\SigHelper;
use SimpleXMLElement;

class SigHelperTest extends \PHPUnit_Framework_TestCase{
	
	/** @var SigHelper */
	protected $fixture;
	
	public function setUp() {
		$this->fixture = new SigHelper('rofoneqaxujagexi');
	}
	
	public function testGetScriptNameFromUrl(){
		$this->assertEquals($this->fixture->getScriptNameFromUrl('www.test.ru/admin/test.php'), 'test.php');
	}
	
	public function testMake(){
		$this->assertEquals($this->fixture->make('payment.php', array('test' => 'test1', 'test2' => 'test3')), '27a5edfcb35e2fa44c9adef6994af3f0');
	}
	
	/**
	 * @dataProvider providerCheck
	 */
	public function testCheck($sig, $scriptName, $params){
		$this->assertTrue($this->fixture->check($sig, $scriptName, $params));
	}
	
	/**
	 * @dataProvider providerMakeXml
	 */
	public function makeXML($sig, $description, $scriptName){
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><response/>');
		$xml->addChild('pg_description', $description);
		
		$this->assertTrue($this->fixture->makeXML($scriptName, $xml));
	}
	
	public function providerCheck(){
		return array(
			array ('27a5edfcb35e2fa44c9adef6994af3f0', 'payment.php', array('test' => 'test1', 'test2' => 'test3')),
			array ('329102fce0b6b85fbd319abd69550447', 'payment.php', array('foo' => array(1, 2))),
		);
	}
	
	public function providerMakeXml(){
		return array(
			array('7e3123d36e6aa859f40dbe4d7eff7c34', 'test', 'test.php'),
			array('5ea94ad2bf3c1780f5e1912f9e4b803c', 'advsfdvsdvsd', 'request'),
		);
	}
}
