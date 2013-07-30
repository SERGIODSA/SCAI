<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');

	if (get_magic_quotes_gpc()!=1)
		$Ser = addslashes($_POST['serie']);
	else
		$Ser = $_POST['serie'];
	$Serie = htmlentities($Ser);
	
	if (get_magic_quotes_gpc()!=1)
		$Sub = addslashes($_POST['subserie']);
	else
		$Sub = $_POST['subserie'];
	$Subserie = htmlentities($Sub);
	
	$Capacidad = $_POST['capacidad'];
	$CajaVieja = $_POST['cajavieja'];
	$idCaja = $_POST['idcaja'];
	$idCarpeta = $_POST['idcarpeta'];
	$nSerieInf = $_POST['nserieinf'];
	$nSerieSup = $_POST['nseriesup'];
	$Tipo = $_POST['tipo'];
	$Fdestruc = $_POST['fdestruc'];
	$Fechatran = $_POST['fechatran'];
	$Fini = $_POST['fini'];
	$Ffin = $_POST['ffin'];
	list($dia,$mes,$ano) = explode('-',$Fdestruc);
	$Fed = $ano.'-'.$mes.'-'.$dia;
		
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->InsertarCarpeta($Serie,$Subserie,$Capacidad,$CajaVieja,$idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Tipo,$Fed,$Fechatran,$Fini,$Ffin);
?>