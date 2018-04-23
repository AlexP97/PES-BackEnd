<?php

interface IDBUser 
{
	public function getUser($username);
	public function existsUser($username);
	public function validLogin($username,$password);
	public function getAll($filter);
}