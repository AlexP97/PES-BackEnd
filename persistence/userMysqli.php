<?php

require_once '../domain/DB.php';
require_once '../persistence/connection.php';

class UserMysqli implements IDBUser 
{
	public function getUser($username) 
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB");
		$sql = Connection::getInstance()->getConnection()->prepare("SELECT username, name, surname, email, country, usertype From Users WHERE username=?");
		$sql->bind_param('s',$username);
		$sql->execute();
		$result = array();
		$sql->bind_result($result['username'],$result['name'],$result['surname'],$result['email'],
			$result['country'],$result['usertype']);
		$sql->fetch();
		$sql->close();

		return $result;
	}

	public function insertUser($data)
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
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
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
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
		if($sql->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$sql->close();
		return $result;
	}
}