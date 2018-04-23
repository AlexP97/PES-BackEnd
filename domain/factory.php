<?php
require '../persistence/userMysqli.php';

class SingletonDataFactory 
{
private static $instance = null;
private static $userDBController = null;
	private function __construct()
	{

	}

	public static function getInstance()
	{
		if(self::$instance == null) {
			self::$instance = new SingletonDataFactory();
		}
		return self::$instance;
	}

	public function getUserDBController()
	{
		if(self::$userDBController == null) {
			self::$userDBController = new UserMysqli();
		}
		return self::$userDBController;
	}
}