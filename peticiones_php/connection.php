<?php
	$servername = 'pes-db.cfkjup36khes.eu-west-1.rds.amazonaws.com';
	$username = 'admin';
	$password = 'assistme';
	$db = 'AssistMe';
	$port = '3306';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db, $port);
/*
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error() . ".\n";
	} else {
		echo "Connected succesfully.\n";
	}*/
?>