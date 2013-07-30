<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');

	$Fechatran = $_POST['Fechatran'];
	$Fdestruc = $_POST['fdestruc'];
	$idCarpeta = $_POST['idcarpeta'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Desincorporar/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarTRD1($idCarpeta,$Fechatran,$Fdestruc);
?>