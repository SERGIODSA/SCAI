<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');
	
	$idCarpeta = $_GET['idcarpeta'];
	$idCaja = $_GET['idcaja'];
	$Expirar = $_GET['expirar'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Desincorporar/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->Destruir($idCaja,$idCarpeta,$Expirar);
?>