<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');

	$Fechatran = $_POST['fechatran'];
	$idCaja = $_POST['idcaja'];
	$idCarpeta = $_POST['idcarpeta'];
	$idCajav = $_POST['idcajav'];
	$Capacidad = $_POST['capacidad'];
	$Fdestruc = $_POST['fdestruc'];
	list($dia, $mes, $ano) = explode('-',$Fdestruc);
	$FDest = $ano."-".$mes."-".$dia;

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarTRD2($Fechatran,$Fdest,$idCaja,$idCarpeta,$idCajav,$Capacidad);	
?>