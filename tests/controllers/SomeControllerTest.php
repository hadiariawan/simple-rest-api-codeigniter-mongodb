<?php

/**
 * @group Controller
 */

class SomeControllerTest extends CIUnit_TestCase
{
	public function setUp()
	{
		// Set the tested controller
		$this->CI = set_controller('books');
	}
	
	public function testWelcomeController()
	{
		// Call the controllers method
		$this->CI->index();
		
		// Fetch the buffered output
		$out = output();
		
		// Check if the content is OK
		$this->assertSame(0, preg_match('/(error|notice)/i', $out));
	}

	public function testUpdateAndFail()
	{

		$message['code']    = 0;
		$message['message'] = 'Error';

		$DataProvider = new MongoData($this->CI,'books');
		$this->CI->load->model('data_model','',FALSE,$DataProvider);

	    $this->assertEquals($this->CI->update(), $message);

	}

	public function testJustEcho()
	{
		$this->assertEquals($this->CI->just_echo('ariawan'), 'ariawan');
	}

}
