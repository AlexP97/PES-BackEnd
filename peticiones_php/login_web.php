<?php
	require '../domain/DB.php';
	require '../persistence/connection.php';
	
	session_start();
	if($_SERVER[REQUEST_METHOD] == "POST"){
		$myusername = mysqli_real_escape_string($db,$_POST['username']);
      	$mypassword = mysqli_real_escape_string($db,$_POST['password']);

      	$sql="SELECT username FROM Users WHERE username = '" . $myusername . "' and password = '" . $mypassword . "';";
		$result = Connection::getInstance()->getConnection()->query($sql);
		if($result && $result->num_rows > 0){
			session_register("myusername");
			$_SESSION['login_user'] = $myusername;
			header("location: create_guide.html");
		} else {
			$error = "Username or password invalid.";
		}
	}
?>

<html>
	<head>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> AssistMe login </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="Shortcut icon" href="Logo.png">
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<form action="" method="POST">
		  <label> Name: </label>
		  <input type="text" name="username">
		  <br>
		  <label> Password: </label>
		  <input type="password" name="password">
		  <br><br>
		  <input type="submit" class="btn btn-primary" value="Submit">
		</form> 
		<div> <?php echo $error; ?> </div>
	</body>
</html>