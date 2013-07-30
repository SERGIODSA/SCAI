<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['DevolverPrestamo']==0)
		header('Location: ../Menu.php');

	$idCaja = $_GET['idcaja'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Devolucion Prestamo/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->DevolverPrestamo($idCaja);
?>