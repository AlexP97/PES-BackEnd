<?php

require_once 'factory.php';

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
		$this->username = isset($_POST["username"]) ? $_POST["username"] : null;
		$this->password = isset($_POST["password"]) ? $_POST["password"] : null;
		if($this->password !== null) $this->password = hash('sha256', $this->password."AssistMe");
		$this->response = new \stdClass();
	}

	public function execute() 
	{
		if($this->username === null || $this->password === null) return json_encode("false");
		$this->response->correct 
			= SingletonDataFactory::getInstance()->getUserDBController()->validLogin($this->username,
				$this->password);
		header('Content-type: application/json');
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
		$this->username = isset($_POST["username"]) ? $_POST["username"] : null;
		$this->password
		 = isset($_POST["user_password"]) ? hash('sha256', $_POST["user_password"]."AssistMe") : null;
		$this->email = isset($_POST["email"]) ? $_POST["email"] : null;
		$this->name = isset($_POST["name"]) ? $_POST["name"] : null;
		$this->surname = isset($_POST["surname"]) ? $_POST["surname"] : null;
		$this->country = isset($_POST["country"]) ? $_POST["country"] : null;

		$this->response = new \stdClass();

		$this->error = FALSE;
	}

	public function execute() 
	{
		if($this->username === null || $this->password === null || $this->email === null) {
			$this->response->correct = "false";
			$this->response->result = "se han enviado campos obligatorios nulos";
		}
		else {
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
		 if($result==="true") {
		 	$this->response->correct = "true";
		 	$this->response->result = "Register correcto.";
		 }
		 else {
		 	$this->response->correct = "false";
		 	$this->response->result = $result;
		 }
		}
		header('Content-type: application/json');
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

/**
* 
*/
class NewGuideRequest extends Transaction
{

	private $username;
	private $data;
	private $title;
	private $response;
	
	function __construct()
	{
		$this->username = isset($_POST["username"]) ? $_POST["username"] : null;
		$this->data = isset($_POST["data"]) ? $_POST["data"] : null;
		$this->title = isset($_POST["title"]) ? $_POST["title"] : null;
		$this->response = new \stdClass();
	}

	public function execute()
	{
		header('Content-type: application/json');
		$this->response->correct 
			= SingletonDataFactory::getInstance()->getGuideDBController()->insertGuide($this->username,
				$this->data, $this->title);
		$myJSON = json_encode($this->response);
		echo $myJSON;
	}
}