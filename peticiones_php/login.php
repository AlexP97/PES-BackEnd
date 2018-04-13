<?php
	require('connection.php');

	$email = $_POST["email"];
	$password = $_POST["password"];
	$password = hash('sha256', $password."AssistMe");

	$sql = "SELECT email FROM Users WHERE email = '" . $email . "' and password = '" . $password . "';";
	$result = $conn->query($sql);
	//header('Content-type: application/json');.
	if($result && $result->num_rows > 0){
		$res->correct = true;
		$myJSON = json_encode($res);
		//echo $myJSON;
	} else {
		$res->correct = false;
		$myJSON = json_encode($res);
		//echo $myJSON;
	}
	$decoded = json_decode($myJSON);
	$correcto = $decoded->{"correct"};
	if($correcto) echo "Login correcto.";
	else echo "Login incorrecto.";
?>
