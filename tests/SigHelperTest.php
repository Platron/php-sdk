<?php

namespace platron_sdk\tests;

use platron_sdk\SigHelper;

class SigHelperTest extends \PHPUnit_Framework_TestCase{
	public function testGetScriptNameFromUrl(){
		$this->assertEquals(SigHelper::getScriptNameFromUrl('www.test.ru/admin/test.php'), 'test.php');
	}
	
	public function testGetOurScriptName(){
		$_SERVER['PHP_SELF'] = 'test/test.php';
		$this->assertEquals(SigHelper::getOurScriptName(), 'test.php');
	}
	
	public function testMake(){
		$this->assertEquals(SigHelper::make('payment.php', array('test' => 'test1', 'test2' => 'test3'), 'rofoneqaxujagexi'), '27a5edfcb35e2fa44c9adef6994af3f0');
	}
	
	public function testCheck(){
		$this->assertTrue(SigHelper::check('27a5edfcb35e2fa44c9adef6994af3f0', 'payment.php', array('test' => 'test1', 'test2' => 'test3'), 'rofoneqaxujagexi'));
		$this->assertTrue(SigHelper::check('329102fce0b6b85fbd319abd69550447', 'payment.php', array(array('foo' => 1, 'foo' => 2)), 'rofoneqaxujagexi'));	
		
		$this->assertFalse(SigHelper::check('asdvdvfvdsfv', 'payment.php', array('test' => 'test1', 'test2' => 'test3'), 'rofoneqaxujagexi'));
		$this->assertFalse(SigHelper::check('27a5edfcb35e2fa44c9adef6994af3f0', 'test.php', array('test' => 'test1', 'test2' => 'test3'), 'rofoneqaxujagexi'));
		$this->assertFalse(SigHelper::check('27a5edfcb35e2fa44c9adef6994af3f0', 'test.php', array('test2' => 'test3'), 'rofoneqaxujagexi'));
	}
	
	public function makeXML(){
		
	}
}
