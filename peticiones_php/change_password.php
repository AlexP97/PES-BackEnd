<?php

	ini_set('display_errors',1);
	require '../domain/transactions.php';

	$tx = new UpdateUserPassword();
	$tx->execute();