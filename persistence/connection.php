<?php

class Connection
{
	private static $instance;
	private $servername = 'pes-db.cfkjup36khes.eu-west-1.rds.amazonaws.com';
	private $username = 'admin';
	private $password = 'assistme';
	private $db = 'AssistMe';
	private $port = '3306';
	private $conn;

	private function __construct() {
		$this->reconnect();	//this time is just a connect method
	}

	public static function getInstance() 
	{
		if(self::$instance==null) {
			self::$instance = new Connection();
		}
		return self::$instance;
	}

	public function getConnection()
	{

		if (mysqli_connect_errno())
		{
			echo "Connection to DB lost: " . mysqli_connect_error() . ".\n";
			echo "trying to reconnect...\n";
			reconnect();
		}
		return $this->conn;
	}

	public function reconnect()
	{
		$this->conn = new mysqli($this->servername, $this->username, $this->password,
		 $this->db, $this->port);

		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error() . ".\n";
		}
	}
}