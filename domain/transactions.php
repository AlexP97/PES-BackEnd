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
	
	private $username;
	private $password;
	private $email;
	private $name;
	private $surname;
	private $country;
	private $resposne;
	private $error;

	function __construct()
	{
		# code...
		$this->username = $_POST["username"];
		$this->password = hash('sha256', $_POST["user_password"]."AssistMe");
		$this->email = $_POST["email"];
		$this->name = $_POST["name"];
		$this->surname = $_POST["surname"];
		$this->country = $_POST["country"];

		$this->response = new \stdClass();

		$this->error = FALSE;
	}

	public function execute() 
	{
		header('Content-type: application/json');
		$data = array(
			"username" => $this->username,
			"password" => $this->password,
			"email" => $this->email,
			"name" => $this->name,
			"surname" => $this->surname,
			"country" => $this->country,
			"usertype" => "normal",
		);
		$result = SingletonDataFactory::getInstance()->getUserDBController()->insertUser($data);
		 if($result) {
		 	$this->response->correct = "true";
		 	$this->response->result = "Register correcto.";
		 }
		 else {
		 	$this->response->correct = "false";
		 	$this->response->result = $result;
		 }
		$myJSON = json_encode($this->response);
		echo $myJSON;
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