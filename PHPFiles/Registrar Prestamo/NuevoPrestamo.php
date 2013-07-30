<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['RegistroPrestamo']==0)
		header('Location: ../menu.php');
	
	$idCaja = $_GET['idcaja'];
	$Ubic = $_GET['ubic'];
	$Estante = $_GET['estante'];
	$Fila = $_GET['fila'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Registrar Prestamo/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->RegistrarPrestamo($idCaja,$Ubic,$Estante,$Fila);
?>