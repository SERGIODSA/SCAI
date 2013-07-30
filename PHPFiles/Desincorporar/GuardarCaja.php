<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');

	$Fechatran = $_POST['Fechatran'];
	$Fdestruc = $_POST['Fdestruc'];	
	$idValor = $_POST['idvalor'];
	$idCarpeta = $_POST['idcarpeta'];
	$idCaja = $_POST['idcaja'];
	$Expirar = $_POST['expirar'];
	$idUbicacion = $_POST['idubi'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Desincorporar/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarCaja($idCarpeta,$idCaja,$idValor,$Fechatran,$Fdestruc,$Expirar,$idUbicacion);
?>