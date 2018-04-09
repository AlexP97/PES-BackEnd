<?php
	require('connection.php');

	//$username = $_POST["username"];
	//$password = $_POST["password"];
	//$password = hash('sha256', $password."AssistMe");

	$username = "elias";
	//$password = hash('sha256', "elias"."AssistMe");
	$password = "elias";
	$sql = "SELECT username FROM Users WHERE username = '" . $username . "' and password = '" . $password . "';";
	$result = $conn->query($sql);
	//header('Content-type: application/json');.
	if($result && $result->num_rows > 0){
		//$res = true;
		//$res.status(200);
		//echo json_encode($res);
		echo "Login correcto.\n";
	} else {
		//$res = false;
		//$res.status(403);
		//echo json_encode($res);
		echo "Cuenta o contraseña incorrectos.\n";
	}
?>
