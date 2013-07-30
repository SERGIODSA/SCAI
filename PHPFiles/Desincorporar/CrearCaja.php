<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');

	$Fechatran = $_POST['fechatran'];
	$Fdestruc = $_POST['fdestruc'];
	$idValor = $_POST['idvalor'];
	$idCarpeta = $_POST['idcarpeta'];
	$idCaja = $_POST['idcaja'];
	$Expirar = $_POST['expirar'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Desincorporar/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->CrearCaja($idCaja,$idCarpeta,$idValor,$Fdestruc,$Fechatran,$Expirar);
?>