<?php
	ini_set('display_errors',1);
	require '../domain/transactions.php';

	$tx = new LoginRequest();
	$tx->execute();

?>