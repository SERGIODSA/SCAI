<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['AsignarRol']==0)
		header('Location: ../menu.php');
		
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Asignar Roles/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ConsultaUsuariosxRol();
?>