<?php

require '../domain/DB.php';
require '../persistence/connection.php';

class UserMysqli implements IDBUser 
{
	public function getUser($username) 
	{

	}
	public function existsUser($username)
	{

	}
	public function validLogin($username,$password)
	{
		$sql="SELECT username FROM Users WHERE username = '" . $username . "' and password = '" . $password . "';";
		$result = Connection::getInstance()->getConnection()->query($sql);
		if($result && $result->num_rows > 0){
		return "true";
		} else {
			return "false";
		}
	}
	public function getAll($filter)
	{

	}
}