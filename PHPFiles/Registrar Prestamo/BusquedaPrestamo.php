<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['RegistroPrestamo']==0)
		header('Location: ../menu.php');

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Registrar Prestamo/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->BuscarPrestamo();	
?>