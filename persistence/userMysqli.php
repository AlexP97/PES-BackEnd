<?php

require_once '../domain/DB.php';
require_once '../persistence/connection.php';

class UserMysqli implements IDBUser 
{
	public function getUser($username) 
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB");
		$sql = Connection::getInstance()->getConnection()->prepare("SELECT username, name, surname, email, country, usertype, url_picture From Users WHERE username=?");
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
		$stament =  Connection::getInstance()->getConnection()->prepare("INSERT INTO Users VALUES (?,?,?,?,?,?,?,?)");
		$stament->bind_param('ssssssss',$data['username'],$data['password'],$data['email'],$data['usertype'],
			$data['name'],$data['surname'],$data['country'],$data['url_picture']);
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
		$sql = Connection::getInstance()->getConnection()->prepare("SELECT username, name, surname, email, country, usertype, password, url_picture From Users WHERE username=? AND password=?");
		$sql->bind_param('ss',$username,$password);
		$sql->execute();
		//$sql->bind_result($result);
		$result = array();
		$sql->bind_result($result['username'],$result['name'],$result['surname'],$result['email'],$result['country'],$result['usertype'],$result['password'],$result['url_picture']);
		$sql->fetch();
		$sql->close();
		if($result['username'] !== null){
			return $result;
		} else {
			return "false";
		}
	}
	public function getAll($filter)
	{

	}
	public function editUser($data) {

		$sql = Connection::getInstance()->getConnection()->prepare("UPDATE Users SET 
			password = IFNULL(?,password), 
			email = IFNULL(?,email),
			name = IFNULL(?,name),
			surname = IFNULL(?,surname), 
			country = IFNULL(?,country), 
			url_picture = IFNULL(?,url_picture)
			WHERE username = ? AND password = ?");
		echo Connection::getInstance()->getConnection()->error;
		$sql->bind_param('ssssssss', $data['password'],$data['email'],$data['name'], $data['surname'],
			$data['country'],$data['url_picture'], $data['username'], $data['current_password']);
		$sql->execute();
		if($sql->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$sql->close();
		return $result;
	}
}