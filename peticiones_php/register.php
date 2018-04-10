<?php
    require 'connection.php';

    $username = $_POST["username"];
	$password = hash('sha256', $_POST["user_password"]."AssistMe");
	$email = $_POST["email"];
	//$usertype = $_POST["usertype"];
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$country = $_POST["country"];

	echo $username;

    $query = "INSERT INTO Users VALUES ('".$username."','".$password."','".$email."','admin','".$name."','".$surname."','".$country."');";

    if ($conn->query($query) === TRUE) {
		echo "New record created successfully";
	} else {
	    echo "Error: " . $query . "<br>" . $conn->error;
	}
?>