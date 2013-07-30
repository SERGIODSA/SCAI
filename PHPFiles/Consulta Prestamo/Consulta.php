<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');
	
	$Atributo = $_GET['atributo'];
	$Campo = $_GET['campo'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Prestamo/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->Consulta($Atributo,$Campo);
?>