<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['IngresarTRD']==0)
		header('Location: ../Menu.php');

	if (get_magic_quotes_gpc()!=1)
		$Ser = addslashes($_POST['Serie']);
	else
		$Ser = $_POST['Serie'];
	$Serie = htmlentities($Ser);
	
	if (get_magic_quotes_gpc()!=1)
		$Sub = addslashes($_POST['Subserie']);
	else
		$Sub = $_GET['Subserie'];
	$Subserie = htmlentities($Sub);
	
	$Fechatran = $_POST['Fechatran'];
	$Tipo = $_POST['Tipo'];
	$nSerieInf = $_POST['nSerieInf'];
	$nSerieSup = $_POST['nSerieSup'];
	$Finicial = $_POST['Finicial'];
	$Ffinal = $_POST['Ffinal'];
	$Fdestruc = $_POST['Fdestruc'];
	$idValor = $_POST['idValor'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Registrar TRD/Operaciones.php');
	$Operacion = New Operaciones;
	$Operacion->CrearCaja($Serie,$Subserie,$Fechatran,$Tipo,$nSerieInf,$nSerieSup,$Finicial,$Ffinal,$Fdestruc,$idValor);	
?>