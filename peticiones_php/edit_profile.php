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


	"UPDATE table_name SET id ='".$id."', title = '".$title."',now() WHERE id = '".$id."' ";

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
?>