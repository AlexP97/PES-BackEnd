<?php

require_once '../domain/DB_Guide.php';
require_once '../persistence/connection.php';

class GuideMysqli implements IDBGuide
{
	public function insertGuide($username,$data,$title,$map)
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$stament =  Connection::getInstance()->getConnection()->prepare("INSERT INTO Guides(username,content,title,interest_points) VALUES (?,?,?,?)");
		$stament->bind_param('ssss',$username,$data,$title,$map);
		$stament->execute();
		if($stament->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$stament->close();
		return $result;
	}
	public function getTitlesGuides($username)
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$stament =  Connection::getInstance()->getConnection()->prepare("SELECT id_guide,title FROM Guides WHERE username = ?");
		$stament->bind_param('s',$username);
		$stament->execute();
		$result = $stament->get_result();
		$res = new stdClass;
		//$res->data = array('id_guide','title');
		$res->data = array();
		while($row = $result->fetch_assoc()){
			array_push($res->data, $row["id_guide"], $row["title"]);
		}
		$res->correct = "true";
		return $res;
	}
	public function getDataGuide($id_guide)
	{
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$stament =  Connection::getInstance()->getConnection()->prepare("SELECT title, content, interest_points FROM Guides WHERE id_guide = ?");
		$stament->bind_param('s',$id_guide);
		$stament->execute();
		$result = $stament->get_result();
		$res = new stdClass;
		$row = $result->fetch_assoc();
		$res->title = $row["title"];
		$res->data = $row["content"];
		$res->points = $row["interest_points"]; 
		$res->correct = "true";
		return $res;
	}
	public function updateGuide($id_guide, $title, $data, $map){
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$stament =  Connection::getInstance()->getConnection()->prepare("UPDATE Guides SET content = ?, title = ?, interest_points = ? WHERE id_guide = ?");
		$stament->bind_param('ssss',$data,$title,$map,$id_guide);
		$stament->execute();
		$res = new stdClass;
		if($stament->affected_rows < 1) $res = Connection::getInstance()->getConnection()->error;
		else $res->correct = "true";
		$stament->close();
		return $res;
	}

	public function getSearchedGuides($contains){
		if(!Connection::getInstance()->getConnection()) throw new Exception("Not enable to connect with DB", 1);
		$likeString = '%' . $contains . '%';
		$stament =  Connection::getInstance()->getConnection()->prepare("SELECT id_guide,title FROM Guides WHERE title LIKE ?");
		$stament->bind_param('s', $likeString);
		$stament->execute();
		$result = $stament->get_result();
		$res = new stdClass;
		//$res->data = array('id_guide','title');
		$res->data = array();
		while($row = $result->fetch_assoc()){
			$array = array(
				"id" => $row["id_guide"],
				"title" => $row["title"],
			);
			array_push($res->data, $array);
		}
		$res->correct = "true";
		return $res;
	}
}