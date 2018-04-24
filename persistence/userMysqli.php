<?php

require '../domain/DB.php';
require '../persistence/connection.php';

class UserMysqli implements IDBUser 
{
	public function getUser($username) 
	{

	}

	public function insertUser($data)
	{
		$queryInsert = "INSERT INTO Users VALUES ('".$data['username']."','".$data['password']."','".$data['email']."','".$data['usertype']."','".$data['name']."','".$data['surname']."','".$data['country']."');";
		$result = Connection::getInstance()->getConnection()->query($queryInsert);
		if(!$result) return Connection::getInstance()->getConnection()->error;
		return TRUE;
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