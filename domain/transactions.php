<?php

require 'factory.php';

/**
* 
*/
abstract class Transaction
{
	abstract protected function execute();
}

/**
* 
*/
class LoginRequest extends Transaction
{
	private $username;
	private $password;
	private $response;

	function __construct()
	{
		# code...
		$this->username = $_POST["username"];
		$this->password = $_POST["password"];
		$this->password = hash('sha256', $this->password."AssistMe");
		$this->response = new \stdClass();
	}

	public function execute() 
	{
		header('Content-type: application/json');
		$this->response->correct 
			= SingletonDataFactory::getInstance()->getUserDBController()->validLogin($this->username,
				$this->password);
		$myJSON = json_encode($this->response);
		echo $myJSON;
	}
}

/**
* 
*/
class UserRequest extends Transaction
{
	
	function __construct()
	{
		# code...
	}
	public function execute()
	{

	}
}

/**
* 
*/
class RegisterRequest extends Transaction
{
	
	function __construct()
	{
		# code...
	}

	public function execute() 
	{

	}
}

/**
* 
*/
class GuideRequest extends Transaction
{
	
	function __construct()
	{
		# code...
	}

	public function execute()
	{

	}
}

/**
* 
*/
class DTOGuideRequest extends Transaction
{
	
	function __construct()
	{
		# code...
	}

	public function execute()
	{

	}
}