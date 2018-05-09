<?php
	ini_set('display_errors',1);
	require '../domain/transactions.php';
	
	$tx = new GetDataGuideRequest();
	http_response_code(200);
	$tx->processRequest();
	$html_code = $tx->response->{'data'};

	require_once '../dompdf/autoload.inc.php';
	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html_code);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream();

	
?>