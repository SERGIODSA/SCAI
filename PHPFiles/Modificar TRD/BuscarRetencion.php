<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');
	
	$idValor = $_GET['idvalor'];
	$Fmr = $_GET['fmr'];
	$Fmryar = $_GET['fmryar'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->BuscarRetencion($idValor,$Fmr,$Fmryar);
?>