<?php

interface IDBGuide
{
	public function insertGuide($username,$data,$title);
	public function getTitlesGuides($username);
	public function getDataGuide($title);
	public function updateGuide($lastTitle, $data, $title);
}