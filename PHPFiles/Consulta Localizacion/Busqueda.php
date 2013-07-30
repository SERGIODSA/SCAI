<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ConsultaLocal']==0)
		header('Location: ../Menu.php');
	
	$Estatus = $_GET['estatus'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Localizacion/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ConsultaLocalizacion($Estatus);
?>