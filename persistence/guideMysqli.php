<?php

require_once '../domain/DB_Guide.php';
require_once '../persistence/connection.php';

class GuideMysqli implements IDBGuide
{
	public function insertGuide($username,$data,$title)
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$stament =  Connection::getInstance()->getConnection()->prepare("INSERT INTO Guides(username,content,title) VALUES (?,?,?)");
		$stament->bind_param('sss',$username,$data,$title);
		$stament->execute();
		if($stament->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$stament->close();
		return $result;
	}
	public function getTitlesGuides($username)
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$stament =  Connection::getInstance()->getConnection()->prepare("SELECT title FROM Guides WHERE username = ?");
		$stament->bind_param('s',$username);
		$stament->execute();
		$result = $stament->get_result();
		$res = new stdClass;
		$res->data = array();
		while($row = $result->fetch_assoc()){
			array_push($res->data, $row["title"]);
		}
		$res->correct = "true";
		return $res;
	}
}