<?php
	require('connection.php');

	$username = $_POST["username"];
	$password = $_POST["password"];
	$password = hash('sha256', $password."AssistMe");

	$sql = "SELECT username FROM Users WHERE username = '" . $username . "' and password = '" . $password . "';";
	$result = $conn->query($sql);

	header('Content-type: application/json');

	if($result && $result->num_rows > 0){
		$res->correct = true;
		$myJSON = json_encode($res);
		echo $myJSON;
	} else {
		$res->correct = false;
		$myJSON = json_encode($res);
		echo $myJSON;
	}
?>
