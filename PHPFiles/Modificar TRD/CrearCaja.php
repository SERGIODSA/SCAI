<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');
		
	if (get_magic_quotes_gpc()!=1)
		$Se = addslashes($_POST['Serie']);
	else
		$Se = $_POST['Serie'];
	$Serie = htmlentities($Se);
	
	if (get_magic_quotes_gpc()!=1)
		$Su = addslashes($_POST['Subserie']);
	else
		$Su = $_POST['Subserie'];
	$Subserie = htmlentities($Su);
	
	$idCaja = $_POST['idCaja'];
	$idCarpeta = $_POST['idCarpeta'];
	$nSerieInf = $_POST['nSerieInf'];
	$nSerieSup = $_POST['nSerieSup'];
	$Tipo = $_POST['Tipo'];
	$Fdestruc = $_POST['Fdestruc'];
	$Fechatran = $_POST['Fechatran'];
	$idValor = $_POST['idValor'];
	$idValorDoc = $_POST['idValorDoc'];
	$Finicial = $_POST['Finicial'];
	$Ffinal = $_POST['Ffinal'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->CrearCaja($Serie,$Subserie,$idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Tipo,$Fdestruc,$Fechatran,$idValor,$idValorDoc,$Finicial,$Ffinal);
?>