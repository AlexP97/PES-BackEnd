<?php
require_once '../persistence/userMysqli.php';
require_once '../persistence/guideMysqli.php';

class SingletonDataFactory 
{
private static $instance = null;
private static $userDBController = null;
private static $guideDBController = null;

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

	public function getGuideDBController()
	{
		if(self::$guideDBController == null) {
			self::$guideDBController = new GuideMysqli();
		}
		return self::$guideDBController;
	}
}