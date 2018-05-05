<?php
	ini_set('display_errors',1);
    require '../domain/transactions.php';

    $tx = new EditUserRequest();
	$tx->execute();
/*

    $username = $_POST["username"];
	$password = hash('sha256', $_POST["user_password"]."AssistMe");
	$email = $_POST["email"];
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$country = $_POST["country"];

	header('Content-type: application/json');

	if($username == "" || $password == "" || $email == "" || $name == "" || $surname == "" || $country == "") {
		$res->correct = "false";
		$res->result = "No has rellenado alguno de los campos."
		$myJSON = json_encode($res);
		echo $myJSON;
		return;
	}

	$queryUpdateProfile = "UPDATE Users SET password = '" . $password . "', email = '" . $email . "', name = '" . $name . "', surname = '" . $surname . "', country = '" . $country . "' WHERE username = '" . $username . "'  ;";

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
	*/
?> 