<?php
    require 'connection.php';

		//return;


    $username = $_POST["username"];
	$password = hash('sha256', $_POST["user_password"]."AssistMe");
	$email = $_POST["email"];
	//$usertype = $_POST["usertype"];
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$country = $_POST["country"];

	header('Content-type: application/json');

	$queryUpdateProfile = "UPDATE username SET password = '" . $password . "', email = '" . $email . "', name = '" . $name . "', surname = '" . $surname . "', country = '" . $country . "';";

	$result = $conn->query($queryUpdateProfile);

	if($result === TRUE) {
		$res->correct = "true";
		$res->result = "Se ha modificado el perfil correctamente.";
		$myJSON = json_encode($res);
		echo $myJSON;
	}
	else {
	    $res->correct = "false";
		$res->result = "Error desconocido.";
		$myJSON = json_encode($res);
		echo $myJSON;
	}
?>