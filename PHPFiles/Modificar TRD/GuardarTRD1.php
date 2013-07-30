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
	
	$idCarpeta = $_POST['idcarpeta'];
	$nSerieInf = $_POST['nserieinf'];
	$nSerieSup = $_POST['nseriesup'];
	$Tipo = $_POST['tipo'];
	$Finicial = $_POST['finicial'];
	$Ffinal = $_POST['ffinal'];
	$Fdestruc = $_POST['fdestruc'];
	list($dia, $mes, $ano) = explode('-',$Fdestruc);
	$FDest = $ano."-".$mes."-".$dia;
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarTRD1($Serie,$Subserie,$idCarpeta,$nSerieInf,$nSerieSup,$Tipo,$Finicial,$Ffinal,$FDest);
?>