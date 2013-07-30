<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['IngresarTRD']==0)
		header('Location: ../Menu.php');
		
	$idValorDoc = $_GET['valores'];
	$Ffinal = $_GET['ffinal'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Registrar TRD/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->BuscarRetencion($idValorDoc,$Ffinal);
?>