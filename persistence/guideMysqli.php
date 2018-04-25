<?php

require_once '../domain/DB_Guide.php';
require_once '../persistence/connection.php';

class GuideMysqli implements IDBGuide
{
	public function insertGuide($username,$data,$title)
	{
		$stament =  Connection::getInstance()->getConnection()->prepare("INSERT INTO Guides(username,content,title) VALUES (?,?,?)");
		$stament->bind_param('sss',$username,$data,$title);
		$stament->execute();
		if($stament->affected_rows<1) $result = Connection::getInstance()->getConnection()->error;
		else $result = "true";
		$stament->close();
		return $result;
	}

}