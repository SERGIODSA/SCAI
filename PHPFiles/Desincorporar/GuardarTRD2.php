<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');

	$Fechatran = $_POST['fechatran'];
	$Fdestruc = $_POST['fdestruc'];
	$idCaja = $_POST['idcaja'];
	$idCarpeta = $_POST['idcarpeta'];
	$idCajav = $_POST['idcajav'];
	$Capacidad = $_POST['capacidad'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Desincorporar/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarTRD2($idCaja,$idCajav,$idCarpeta,$Capacidad,$Fechatran,$Fdestruc);
?>