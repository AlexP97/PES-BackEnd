<?php
    ini_set('display_errors',1);
	require '../domain/transactions.php';

    $tx = new RegisterRequest();
    $tx->execute();

    http_response_code(200);
		//return;
/*

    $username = $_POST["username"];
	$password = hash('sha256', $_POST["user_password"]."AssistMe");
	$email = $_POST["email"];
	//$usertype = $_POST["usertype"];
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$country = $_POST["country"];

	$res = new \stdClass();

	$error = FALSE;

	header('Content-type: application/json');

	/*if($username == "" || $password == "" || $email == "" || $name == "" || $surname == "" || $country == "") {
		$res->correct = "false";
		$res->result = "No has rellenado alguno de los campos."
		$myJSON = json_encode($res);
		echo $myJSON;
		return;
	}*/
/*
	$querySelectUsername = "SELECT username FROM Users WHERE username = '" . $username . "';";
	$result = $conn->query($querySelectUsername);
	if($result && $result->num_rows > 0){
		$res->correct = "false";
		$res->result = "Usuario ya existente.";
		$myJSON = json_encode($res);
		echo $myJSON;
		return;
	}

	$querySelectEmail = "SELECT email FROM Users WHERE email = '" . $email . "';";
	$result = $conn->query($querySelectEmail);
	if($result && $result->num_rows > 0){
		$res->correct = "false";
		$res->result = "Email ya existente.";
		$myJSON = json_encode($res);
		echo $myJSON;
		return;
	}

    $queryInsert = "INSERT INTO Users VALUES ('".$username."','".$password."','".$email."','admin','".$name."','".$surname."','".$country."');";

    if ($conn->query($queryInsert) === TRUE) {
		$res->correct = "true";
		$res->result = "Register correcto.";
		$myJSON = json_encode($res);
		echo $myJSON;
		//return;
	} else {
	    $res->correct = "false";
		$res->result = "Error desconocido.";
		$myJSON = json_encode($res);
		echo $myJSON;
		//return;
	}
?>*/