<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Parametros']==0)
		header('Location: ../Menu.php');
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Parametros/Operaciones.php');
	$Operacion = New Operaciones;
	$Operacion->EditarParametro();
?>