<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['IngresarTRD']==0)
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
	
	$nSerieInf = $_POST['nserieinf'];
	$nSerieSup = $_POST['nseriesup'];
	$Tipo = $_POST['tipo'];
	$idCaja = $_POST['idcaja'];
	$Capacidad = $_POST['capacidad'];
	
	list($dia, $mes, $ano) = explode('-',$_POST['finicial']);
	$Finicial = $ano.'-'.$mes.'-'.$dia;
	list($dia, $mes, $ano) = explode('-',$_POST['ffinal']);
	$Ffinal = $ano.'-'.$mes.'-'.$dia;
	list($dia,$mes,$resto1) = explode('-',$_POST['fechatran']);
	list($resto2,$minuto,$segundo) = explode(':',$resto1);
	list($ano,$hora) = explode(' ',$resto2);
	$Fechatran = $ano.'-'.$mes.'-'.$dia.'   '.$hora.':'.$minuto;
	$f = time()-16200;
	$Fechacre = date("Y-m-d",$f);
	list($dia, $mes, $ano) = explode('-',$_POST['fdestruc']);
	$FDest = $ano."-".$mes."-".$dia;

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Registrar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->InsertarCarpeta($Serie,$Subserie,$nSerieInf,$nSerieSup,$Tipo,$idCaja,$Capacidad,$Finicial,$Ffinal,$Fechatran,$FDest,$Fechacre);
?>