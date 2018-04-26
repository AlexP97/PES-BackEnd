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
		$stament =  Connection::getInstance()->getConnection()->prepare("INSERT INTO Users VALUES (?,?,?,?,?,?,?)");
		$stament->bind_param('sssssss',$data['username'],$data['password'],$data['email'],$data['usertype'],
			$data['name'],$data['surname'],$data['country']);
		$stament->execute();
		if($stament->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$stament->close();
		return $result;
	}

	public function existsUser($username)
	{

	}
	public function validLogin($username,$password)
	{
		$sql = Connection::getInstance()->getConnection()->prepare("SELECT username From Users WHERE username=? AND password=?");
		$sql->bind_param('ss',$username,$password);
		$sql->execute();
		$sql->bind_result($result);
		$sql->fetch();
		$sql->close();
		if($result !== null){
		return "true";
		} else {
			return "false";
		}
	}
	public function getAll($filter)
	{

	}
	public function editUser($data) {
		$sql = Connection::getInstance()->getConnection()->prepare("UPDATE Users SET password = ?, email = ?, name = ?, surname = ?, country = ? WHERE username = ?");
		$sql->bind_param('ssssss', $data['password'], $data['email'], $data['name'], $data['surname'], $data['country'], $data['username']);
		$sql->execute();
		if($stament->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$stament->close();
		return $result;
	}
}