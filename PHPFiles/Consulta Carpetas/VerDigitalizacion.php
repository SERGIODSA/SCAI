<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ConsultaCarpetas']==0)
		header('Location: ../Menu.php');

	$idCarpeta = $_GET['idCarpeta'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Carpetas/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->VerDigitalizacion($idCarpeta);
?>