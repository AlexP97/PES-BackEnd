<?php
	ini_set('display_errors',1);
	require_once '../domain/transactions.php';
	$tx = new GetGuidesRequest();
	http_response_code(200);
	$tx->execute();