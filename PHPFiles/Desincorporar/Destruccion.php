<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');

	$idCarpeta = $_POST['idcarpeta'];
	$idCaja = $_POST['idcaja'];
	$Fechades = $_POST['fechades'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Desincorporar/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->Destruccion($idCarpeta,$idCaja,$Fechades);
?>