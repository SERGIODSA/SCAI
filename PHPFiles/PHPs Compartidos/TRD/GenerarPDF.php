<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
		
	$idCaja = $_GET['idcaja'];
	$Fechatran = $_GET['fechatran'];
	include('../../PHPs Compartidos/TRD/TRDenPDF.php');
	$pdf = new PDF('L','mm','letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Descripcion($idCaja,$Fechatran);
	$pdf->TRDCabeza();
	$pdf->TRDCuerpo($idCaja);
	$pdf->Output();
?>