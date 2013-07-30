<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Roles']==0)
		header('Location: ../menu.php');

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Definir Roles/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->CrearRol();
?>