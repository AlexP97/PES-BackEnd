<?php

require_once 'factory.php';

/**
* 
*/
abstract class Transaction
{
	protected $parameters; 
	public $response;

	abstract protected function checkParameters();
	abstract protected function processRequest();

	public function execute() 
	{
		$this->parameters = array('valid'	 =>		true, 	//false -> invalid response
								  'session'  =>		0,			// 0 -> guest, 1-> normal 2-> admin
								  'error'	 =>		"ok");
		$this->checkParameters();
		$this->response = new \stdClass();
		$this->processRequest();
		header('Content-type: application/json');
		$myJSON = json_encode($this->response);
		echo $myJSON;
	}

	public function get_response(){
		echo $response;
	}
}

/**
* 
*/
class LoginRequest extends Transaction
{
	private $username;
	private $password;

	function __construct()
	{
		# code...
		$this->username = isset($_POST["username"]) ? $_POST["username"] : null;
		$this->password = isset($_POST["password"]) ? $_POST["password"] : null;
		if($this->password !== null) $this->password = hash('sha256', $this->password."AssistMe");
	}

	public function checkParameters()
	{
		if($this->username === null || $this->password === null) {
			$this->parameters['valid'] = false;
			$this->parameters['error'] = "invalid null parameter on uri";
		}

	}
	
	public function processRequest()
	{
		if(!$this->parameters['valid']) {
			$this->response->error = $this->parameters['error'];
			$this->response->correct = "false";
		}
		else {
			$this->response->correct = "true";
			$this->response->data = SingletonDataFactory::getInstance()->getUserDBController()->validLogin($this->username,$this->password);
		}
	}
}

// Verificar si la "cokkie" guardada puede logearse
class CheckLoginRequest extends Transaction
{
	private $username;
	private $password;

	function __construct()
	{
		# code...
		$this->username = isset($_POST["username"]) ? $_POST["username"] : null;
		$this->password = isset($_POST["password"]) ? $_POST["password"] : null;
	}

	public function checkParameters()
	{
		if($this->username === null || $this->password === null) {
			$this->parameters['valid'] = false;
			$this->parameters['error'] = "invalid null parameter on uri";
		}

	}
	
	public function processRequest()
	{
		if(!$this->parameters['valid']) {
			$this->response->error = $this->parameters['error'];
			$this->response->correct = "false";
		}
		else {
			$this->response->correct = "true";
			$this->response->data = SingletonDataFactory::getInstance()->getUserDBController()->validLogin($this->username,$this->password);
		}
	}
}

/**
* 
*/
class EditUserRequest extends Transaction
{
	private $username;
	private $password;
	private $email;
	private $name;
	private $surname;
	private $country;
	private $url_picture;
	private $current_password;

	function __construct()
	{
		# code...
		$this->username = isset($_POST["username"]) && $_POST['username'] !== "" ? $_POST["username"] : null;
		$this->password = isset($_POST["user_password"]) && $_POST['user_password'] !== "" ?
		 hash('sha256', $_POST["user_password"]."AssistMe") : null;
		$this->email = isset($_POST["email"])&& $_POST['email'] !== "" ? $_POST["email"] : null;
		$this->name = isset($_POST["name"]) && $_POST['name'] !== "" ? $_POST['name'] : null;
		$this->surname = isset($_POST["surname"]) && $_POST['surname'] !== "" ? $_POST["surname"] : null;
		$this->country = isset($_POST["country"]) && $_POST['country'] !== "" ? $_POST["country"] : null;
		$this->url_picture = isset($_POST["url_picture"]) && $_POST['url_picture'] !== "" ? $_POST["url_picture"] : null;
		$this->current_password = isset($_POST["current_password"]) && $_POST['current_password'] !== ""? 
		hash('sha256', $_POST["current_password"]."AssistMe") : null;
	}

	public function checkParameters()
	{
		if(is_null($this->current_password) || is_null($this->username)) 
			$this->parameters['valid'] = false;
	}

	public function processRequest()
	{
		$data = array(
			"username" => $this->username,
			"password" => $this->password,
			"email" => $this->email,
			"name" => $this->name,
			"surname" => $this->surname,
			"country" => $this->country,
			"url_picture" => $this->url_picture,
			"current_password" => $this->current_password,
		);
		$result = "";
		if($this->parameters['valid'])
			$result = SingletonDataFactory::getInstance()->getUserDBController()->editUser($data);
		 if($result==="true") {
		 	$this->response->correct = "true";
			$this->response->result = "Se ha modificado el perfil correctamente.";
		 }
		 else {
		 	$this->response->correct = "false";
		 	$this->response->result = $result;
		 }
	}
}

/**
* 
*/
class UserRequest extends Transaction
{
	private $requiredUser;

	function __construct()
	{
		# code...
		$this->requiredUser = isset($_GET['username']) ? $_GET['username'] : null;
	}

	public function checkParameters()
	{
		if(is_null($this->requiredUser)) 
			$this->parameters['valid'] = false;
	}

	public function processRequest()
	{
		
		if($this->parameters['valid']) {
			$result = SingletonDataFactory::getInstance()->getUserDBController()->getUser($this->requiredUser);
			$this->response->correct = "true";
			$this->response->userData = $result;
		}
		else {
			$this->response->correct = "false";
		}
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
	private $url_picture;
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
		$this->url_picture = isset($_POST["url_picture"]) ? $_POST["url_picture"] : null;

		$this->error = FALSE;
	}

	public function checkParameters()
	{
				if($this->username === null || $this->password === null || $this->email === null) {
			$this->response->correct = "false";
			$this->response->result = "se han enviado campos obligatorios nulos";
		}
	}

	public function processRequest()
	{
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

	public function checkParameters()
	{

	}

	public function processRequest()
	{

	}
}

/**
* 
*/
class DTOGuideRequest 
{
	
	function __construct()
	{
		# code...
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
	private $map;
	
	function __construct()
	{
		$this->username = isset($_POST["username"]) ? $_POST["username"] : null;
		$this->data = isset($_POST["data"]) ? $_POST["data"] : null;
		$this->title = isset($_POST["title"]) ? $_POST["title"] : null;
		$this->map = isset($_POST["map"]) ? $_POST["map"] : null;
	}

	public function checkParameters()
	{

	}

	public function processRequest()
	{
		$this->response->correct 
			= SingletonDataFactory::getInstance()->getGuideDBController()->insertGuide($this->username,
			$this->data, $this->title, $this->map);
	}
}

/**
* 
*/
class GetGuidesRequest extends Transaction
{

	private $username;
	
	function __construct()
	{
		$this->username = isset($_GET["username"]) ? $_GET["username"] : null;
	}

	public function checkParameters()
	{

	}

	public function processRequest()
	{
		$this->response
			= SingletonDataFactory::getInstance()->getGuideDBController()->getTitlesGuides($this->username);
	} 
}

class GetDataGuideRequest extends Transaction
{
	private $id_guide;
	function __construct()
	{
		$this->id_guide = isset($_GET["id_guide"]) ? $_GET["id_guide"] : null;
	}

	public function checkParameters()
	{

	}

	public function processRequest()
	{
		$this->response
			= SingletonDataFactory::getInstance()->getGuideDBController()->getDataGuide($this->id_guide);
	}


}

class UpdateDataGuideRequest extends Transaction
{
	private $id_guide;
	private $title;
	private $data;
	private $map;
	
	function __construct()
	{
		$this->id_guide = isset($_POST["id_guide"]) ? $_POST["id_guide"] : null;
		$this->title = isset($_POST["title"]) ? $_POST["title"] : null;
		$this->data = isset($_POST["data"]) ? $_POST["data"] : null;
		$this->map = isset($_POST["map"]) ? $_POST["map"] : null;
	}

	public function checkParameters()
	{

	}

	public function processRequest()
	{
		$this->response
			= SingletonDataFactory::getInstance()->getGuideDBController()->updateGuide($this->id_guide, $this->title, $this->data, $this->map);
	}
}

class SearchGuideRequest extends Transaction {
	private $contains;
	
	function __construct()
	{
		$this->contains = isset($_GET["contains"]) ? $_GET["contains"] : null;
	}

	public function checkParameters()
	{

	}

	public function processRequest()
	{
		$this->response
			= SingletonDataFactory::getInstance()->getGuideDBController()->getSearchedGuides($this->contains);
	} 
}
