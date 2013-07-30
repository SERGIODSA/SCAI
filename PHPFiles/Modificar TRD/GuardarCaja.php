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
	
	$Fechatran = $_POST['fechatran'];
	$Tipo = $_POST['tipo'];
	$nSerieInf = $_POST['nserieinf'];
	$nSerieSup = $_POST['nseriesup'];
	$Finicial = $_POST['finicial'];
	$Ffinal = $_POST['ffinal'];
	$Fdestruc = $_POST['fdestruc'];
	$idValor = $_POST['idvalor'];
	$idUbicacion = $_POST['idubi'];
	$idCaja = $_POST['idcaja'];
	$idCarpeta = $_POST['idcarpeta'];
	$idValorDoc = $_POST['idvalordoc'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = New Operaciones;
	$Operacion->GuardarCaja($idCaja,$idCarpeta,$Serie,$Subserie,$Fechatran,$Tipo,$nSerieInf,$nSerieSup,$Finicial,$Ffinal,$Fdestruc,$idValor,$idUbicacion,$idValorDoc);
?>