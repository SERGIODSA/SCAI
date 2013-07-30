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
	
	$idCaja = $_POST['idcaja'];
	$idCarpeta = $_POST['idcarpeta'];
	$nSerieInf = $_POST['nserieinf'];
	$nSerieSup = $_POST['nseriesup'];
	$Tipo = $_POST['tipo'];
	$Fdestruc = $_POST['fdestruc'];
	$Fechatran = $_POST['fechatran'];
	$idValor = $_POST['idvalor'];
	$idValorDoc = $_POST['idvalordoc'];
	// fechas formato dd/mm/aaaa
	list($ano1, $mes1, $dia1) = explode('-',$_POST['finicial']);
	list($ano2, $mes2, $dia2) = explode('-',$_POST['ffinal']);
	$Fini = $_POST['finicial'];
	$Ffin = $_POST['ffinal'];
	// Fin fechas
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->EditarTRD2($idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Serie,$Subserie,$Tipo,$Fdestruc,$Fechatran,$idValor,$idValorDoc,$Fini,$Ffin);
?>