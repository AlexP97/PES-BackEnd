<?php

interface IDBGuide
{
	public function insertGuide($username,$data,$title);
	public function getTitlesGuides($username);
}