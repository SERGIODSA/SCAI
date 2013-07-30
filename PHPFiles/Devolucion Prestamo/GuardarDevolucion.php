<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['DevolverPrestamo']==0)
		header('Location: ../Menu.php');

	$Fecha1 = $_POST['fecha1'];
	$idCaja = $_POST['idcaja'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Devolucion Prestamo/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarDevolucion($idCaja,$Fecha1);
?>