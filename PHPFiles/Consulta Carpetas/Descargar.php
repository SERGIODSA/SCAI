<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ConsultaCarpetas']==0)
		header('Location: ../Menu.php');
	
	$idDig = $_GET['id'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Carpetas/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->Descargar($idDig);
?>