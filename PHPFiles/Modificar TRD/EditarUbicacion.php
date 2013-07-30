<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');
		
	$idCaja = $_GET['idCaja'];
	$idUbicacion = $_GET['idUbicacion'];
	$Ffinal = $_GET['Ffinal'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->EditarUbicacion($idCaja,$idUbicacion,$Ffinal);
?>